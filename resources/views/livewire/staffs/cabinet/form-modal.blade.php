<?php

use Illuminate\Http\Request;
use Livewire\Volt\Component;
use App\Models\Staff\Staff;
use Livewire\Attributes\On;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;

new class extends Component {
    use WithFileUploads;

    public ?Staff $staff = null;
    public bool $isOpen = false;

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

    public ?UploadedFile $photoFile = null;
    public ?string $avatar = null;

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
            'photoFile' => 'nullable|image|max:5120',
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

        $this->education = $this->staff->education ?? '';
        $this->retraining = $this->staff->retraining ?? '';
        $this->awards = $this->staff->awards ?? '';
        $this->avatar =  $this->staff->image('avatar')->path;

        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;

        $this->reset();

        $this->resetValidation();
    }

    public function deletePhoto(): void
    {
        if ($this->photoFile) {
            $this->photoFile = null;
            $this->dispatch('notify', message: 'Выбор файла отменен');
            return;
        }

        if (is_null($this->avatar)) return;

        if (Storage::disk('public')->exists($this->avatar))
            Storage::disk('public')->delete($this->avatar);

        if ($this->staff)
            $this->staff->image('avatar')->forceDelete();

        $this->avatar = null;

        $this->dispatch('notify', message: 'Фото удалено');

        $this->dispatch('staff-updated');
    }
    public function save(): void
    {
        $form = $this->validate();

        $phonesArray = array_filter(array_map('trim', explode(',', $this->phones)));
        $emailsArray = array_filter(array_map('trim', explode(',', $this->emails)));

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


        if($this->photoFile){
            if ($this->avatar && Storage::disk('public')->exists($this->avatar)) {
                Storage::disk('public')->delete($this->avatar);
            }

            $directory = "images/staffs/{$this->staff->id}";
            $filename = Str::random(40) . '.webp';
            $fullPath = "{$directory}/{$filename}";

            $manager = new \Intervention\Image\ImageManager(new \Intervention\Image\Drivers\Gd\Driver());
            $image = $manager->read($this->photoFile->getRealPath())->toWebp(80);

            Storage::disk('public')->put($fullPath, (string) $image);

            $this->staff->image('avatar')->fill([
                'path' => $fullPath
            ])->save();
        }

        $this->dispatch('notify', message: 'Изменения успешно сохранены!');
        $this->dispatch('staff-updated');

        //        $this->closeModal();
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
            <div class="relative w-full max-w-7xl rounded-lg bg-white shadow-2xl flex flex-col lg:h-[85vh]"
                 wire:click.away="closeModal">

                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">
                        Редактирование сотрудника: {{ $lastname }} {{ $firstname }} (#{{ $staff?->id }})
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M6 18L18 6M6 6l12 12"/>
                        </svg>
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
                        @click="activeTab = 'photo'"
                        :class="activeTab === 'photo' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
                        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
                    >
                        Фото
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

                        @include('livewire.staffs.cabinet.form-modal-general')

                        @include('livewire.staffs.cabinet.form-modal-photo')

                        <div x-show="activeTab === 'education'" class="flex flex-col h-full max-h-full min-h-0 w-full">

                            <livewire:staffs.cabinet.form-modal-education />

                            <livewire:staffs.cabinet.form-modal-retraining />
                        </div>

                    </div>

                    <div class="px-6 py-4 border-t border-gray-100 bg-gray-50 flex gap-2">

                        <div class="flex-1 flex items-center">
                            <div
                                x-data="{ show: false, message: '', timer: null }"
                                @notify.window="
                                    clearTimeout(timer);
                                    message = $event.detail.message;
                                    show = true;
                                    timer = setTimeout(() => show = false, 4000);
                                "
                                x-show="show"
                                x-transition:enter="transition ease-out duration-300"
                                x-transition:enter-start="opacity-0 transform -translate-x-2"
                                x-transition:enter-end="opacity-100 transform translate-x-0"
                                x-transition:leave="transition ease-in duration-200"
                                x-transition:leave-start="opacity-100"
                                x-transition:leave-end="opacity-0"
                                class="flex items-center gap-2 text-sm font-medium text-green-600 bg-green-50 px-3 py-1.5 rounded-md border border-green-200"
                                x-cloak
                            >
                                <svg class="h-4 w-4 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span x-text="message"></span>
                            </div>
                        </div>
                        <button type="button" wire:click="closeModal"
                                class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 transition rounded-md">
                            Отмена
                        </button>
                        <button type="submit"
                                class="px-5 py-2 text-sm font-semibold bg-blue-600 hover:bg-blue-700 text-white transition rounded-md shadow-sm">
                            Сохранить изменения
                        </button>
                    </div>

                </form>
            </div>
        </div>
    @endif
</div>
