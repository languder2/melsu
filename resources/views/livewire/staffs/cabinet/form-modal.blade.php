<?php

use Livewire\Volt\Component;
use App\Models\Staff\Staff;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage; // Обязательно импортируем

new class extends Component {
    use WithFileUploads;

    public ?Staff $staff = null;
    public bool $isOpen = false;

    // Свойства для вкладки "Общие"
    public string $lastname = '';
    public string $firstname = '';
    public string $middle_name = '';
    public string $birthday = '';
    public string $birthplace = '';
    public string $residence = '';
    public string $family_status = '';
    public string $affiliation = '';
    public string $address = '';
    public string $reception_time = '';
    public string $alias = '';
    public string $link = '';

    public string $phones = '';
    public string $emails = '';

    public string $education = '';
    public string $retraining = '';
    public string $awards = '';

    // ИСПРАВЛЕНИЕ: photoFile должен вмещать объект временного файла, photo - путь из БД
    public $photoFile = null;
    public ?string $photo = null;

    protected function rules()
    {
        return [
            'lastname' => 'required|string|max:255',
            'firstname' => 'required|string|max:255',
            'middle_name' => 'nullable|string|max:255',
            'birthday' => 'nullable|date',
            'birthplace' => 'nullable|string|max:255',
            'residence' => 'nullable|string|max:255',
            'family_status' => 'nullable|string|max:255',
            'affiliation' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:255',
            'reception_time' => 'nullable|string|max:255',
            'alias' => 'nullable|string|max:255',
            'link' => 'nullable|url|max:255',
            'education' => 'nullable|string',
            'retraining' => 'nullable|string',
            'awards' => 'nullable|string',
            // ДОБАВЛЕНО: Валидация для загружаемого фото
            'photoFile' => 'nullable|image|max:5120', // макс 5MB (5120 КБ)
        ];
    }

    #[On('open-edit-modal')]
    public function openModal(int $id): void
    {
        $this->staff = Staff::findOrFail($id);

        $this->lastname = $this->staff->lastname ?? '';
        $this->firstname = $this->staff->firstname ?? '';
        $this->middle_name = $this->staff->middle_name ?? '';
        $this->birthday = $this->staff->birthday ?? '';
        $this->birthplace = $this->staff->birthplace ?? '';
        $this->residence = $this->staff->residence ?? '';
        $this->family_status = $this->staff->family_status ?? '';
        $this->affiliation = $this->staff->affiliation ?? '';
        $this->address = $this->staff->address ?? '';
        $this->reception_time = $this->staff->reception_time ?? '';
        $this->alias = $this->staff->alias ?? '';
        $this->link = $this->staff->link ?? '';

        $this->education = $this->staff->education ?? '';
        $this->retraining = $this->staff->retraining ?? '';
        $this->awards = $this->staff->awards ?? '';

        // ДОБАВЛЕНО: Подгружаем текущий путь к фото из модели
        $this->photo = $this->staff->photo ?? null;

        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;

        $this->reset([
            'lastname', 'firstname', 'middle_name', 'birthday', 'birthplace', 'residence',
            'family_status', 'affiliation', 'address', 'reception_time', 'alias', 'link',
            'phones', 'emails', 'education', 'retraining', 'awards', 'staff',
            'photoFile', 'photo' // Очищаем свойства фото
        ]);

        $this->resetValidation();
    }

    // ДОБАВЛЕНО: Метод удаления фото (как временного, так и уже сохраненного)
    public function deletePhoto(): void
    {
        // Если была загружена только временная картинка, просто сбрасываем ее
        if ($this->photoFile) {
            $this->photoFile = null;
            return;
        }

        // Если удаляем уже существующее фото из БД и с диска
        if ($this->photo) {
            if (Storage::disk('public')->exists($this->photo)) {
                Storage::disk('public')->delete($this->photo);
            }

            if ($this->staff) {
                $this->staff->update(['photo' => null]);
            }

            $this->photo = null;
        }
    }

    public function save(): void
    {
        $this->validate();

        $phonesArray = array_filter(array_map('trim', explode(',', $this->phones)));
        $emailsArray = array_filter(array_map('trim', explode(',', $this->emails)));

        dd($this->staff->avatar);






        if ($this->photoFile) {
            if ($this->photo && Storage::disk('public')->exists($this->photo))
                Storage::disk('public')->delete($this->photo);

            $this->photo = $this->photoFile->store('staff-photos', 'public');

        }

        $this->staff->update([
            'lastname' => $this->lastname,
            'firstname' => $this->firstname,
            'middle_name' => $this->middle_name ?: null,
            'birthday' => $this->birthday ?: null,
            'birthplace' => $this->birthplace ?: null,
            'residence' => $this->residence ?: null,
            'family_status' => $this->family_status ?: null,
            'affiliation' => $this->affiliation ?: null,
            'address' => $this->address ?: null,
            'reception_time' => $this->reception_time ?: null,
            'alias' => $this->alias ?: null,
            'link' => $this->link ?: null,
            'education' => $this->education ?: null,
            'retraining' => $this->retraining ?: null,
            'awards' => $this->awards ?: null,
        ]);

        $this->dispatch('staff-updated');

        $this->closeModal();
    }
};
?>

<div>
    @if($isOpen)
        <div
            x-data="{ activeTab: 'general' }"
            @keydown.escape.window="$wire.closeModal()"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-xs"
        >
            <div class="relative w-full max-w-7xl rounded-lg bg-white shadow-2xl flex flex-col lg:h-[85vh]" wire:click.away="closeModal">

                <!-- Шапка -->
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">
                        Редактирование сотрудника: {{ $lastname }} {{ $firstname }} (#{{ $staff?->id }})
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/></svg>
                    </button>
                </div>

                <div class="flex border-b border-gray-200 bg-gray-50 px-6 gap-2">
                    <button
                        type="button"
                        @click="activeTab = 'general'"
                        :class="activeTab === 'general' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
                    >
                        Общие сведения
                    </button>
                    <button
                        type="button"
                        @click="activeTab = 'education'"
                        :class="activeTab === 'education' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
                    >
                        Образование (Education)
                    </button>
                </div>

                <form wire:submit="save" class="flex flex-col flex-1 overflow-hidden">

                    <div class="p-6 overflow-y-auto flex-1 max-h-[calc(90vh-180px)]">

                        <div x-show="activeTab === 'general'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            @include('livewire.staffs.cabinet.form-modal-general')
                            @include('livewire.staffs.cabinet.form-modal-photo')
                        </div>

                        <div x-show="activeTab === 'education'" class="flex flex-col gap-2">
                            <label class="block text-xs font-semibold text-gray-700">Сведения об образовании</label>
                            <textarea wire:model="education" rows="8" class="w-full rounded border border-gray-300 px-3 py-2 text-sm focus:border-blue-500 outline-none" placeholder="Опишите полученное образование..."></textarea>
                            @error('education') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
                        </div>
                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex justify-end gap-2">
                        <button type="button" wire:click="closeModal" class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 transition rounded-md">
                            Отмена
                        </button>
                        <button type="submit" class="px-5 py-2 text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white transition rounded-md shadow-sm">
                            Сохранить изменения
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif
</div>
