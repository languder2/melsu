<?php

use Livewire\Volt\Component;
use Livewire\WithFileUploads;
use App\Models\Education\Speciality;
use Livewire\Attributes\On;
use App\Models\Division\Division;
use App\Http\Requests\Education\SpecialityRequest;
use Illuminate\Validation\Rule;

new class extends Component {
    use WithFileUploads;

    public string $currentTab = 'general';
    public bool $isOpen = false;
    public ?Speciality $speciality = null;

    public string $code = '';
    public string $spec_code = '';
    public string $name = '';
    public string $name_profile = '';
    public string $department = '';
    public string $level = '';
    public ?int $courses = null;
    public int $favorite = 0;
    public bool $show = true;
    public ?int $institute_id = null;
    public ?int $faculty_id = null;
    public ?int $department_id = null;

    public function with(): array
    {
        return [
            'levels' => \App\Enums\EducationLevel::cases(),
            'divisions' => Division::educationalDepartments()->orderBy('name')->pluck('name', 'id'),
        ];
    }

    public function boot(): void
    {
        if (!auth()->check() || !auth()->user()->isEditor())
            abort(403, 'У вас нет прав для управления специальностями.');
    }

    protected function rules(): array
    {
        $rules = (new SpecialityRequest())->rules();

        $rules['code'] = [
            'nullable',
            'string',
            'max:255',
            Rule::unique('education_specialities', 'code')->ignore($this->speciality?->id),
        ];

        $rules['show'] = 'boolean';

        return $rules;
    }

    protected function messages(): array
    {
        return (new SpecialityRequest())->messages();
    }

    #[On('open-edit-modal')]
    public function openModal(?int $id = null): void
    {
        $this->resetValidation();

        $this->speciality = Speciality::with('profiles')->withTrashed()->findOrNew($id);

        $this->code             = $this->speciality->code ?? '';
        $this->spec_code        = $this->speciality->spec_code ?? '';
        $this->name             = $this->speciality->name ?? '';
        $this->name_profile     = $this->speciality->name_profile ?? '';
        $this->level            = $this->speciality->level->value ?? '';
        $this->courses          = $this->speciality->courses;
        $this->favorite         = $this->speciality->favorite ?? 0;

        $this->show             = !isset($this->speciality->show) || (bool)$this->speciality->show;

        $this->institute_id     = $this->speciality->institute_id ?? null;
        $this->faculty_id       = $this->speciality->faculty_id ?? null;
        $this->department_id    = $this->speciality->department_id ?? null;

        $this->isOpen = true;
    }

    public function save(): void
    {
        try {
            $validated = $this->validate();
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Получаем весь массив ошибок: ['field_name' => ['Error message']]
            $errors = $e->validator->errors()->toArray();

            // Дампим в консоль/экран для отладки
            dd($errors);

            // Или логируем: info($errors);

            throw $e; // Обязательно пробрасываем дальше, чтобы Livewire вывел их во фронтенд
        }

        $validated = $this->validate();

        dd(2);

        $this->speciality->fill($validated);

        $hasChanges = $this->speciality->isDirty();

        $this->speciality->save();

        if ($hasChanges) {
            $this->dispatch('notify', "Изменения сохранены.<br>#{$this->speciality->id} {$this->speciality->spec_code}<br>{$this->speciality->name}.<br>{$this->speciality->name_profile}");
            $this->dispatch('refresh-specialities');
        }

//        $this->dispatch('save-profile', speciality: $this->speciality );

    }

    public function closeModal(): void
    {
        $this->isOpen = false;
        $this->currentTab = 'general';

        $this->reset([
            'speciality', 'code', 'spec_code', 'name',
            'name_profile', 'level', 'courses', 'favorite',
            'institute_id', 'faculty_id', 'department_id'
        ]);

        $this->show = true;

        $this->resetValidation();
    }
}; ?>

<div>
    @if($isOpen)
        <div
            x-data="{ activeTab: $wire.$entangle('currentTab', true) }"
            @keydown.escape.window="$wire.closeModal()"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-xs"
        >
            <div
                class="relative w-full max-w-7xl rounded-lg bg-white shadow-2xl flex flex-col lg:max-h-[85vh]"
                wire:click.self="closeModal"
                @click.stop
            >
                <div class="px-6 py-4 border-b border-gray-100 flex justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">
                        @if($speciality->exists)
                            #{{ $speciality->id }} {{ $speciality->spec_code }}
                        @else
                            Новая специальность
                        @endif
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                @include('livewire.specialities.cabinet.form-modal-tabs')

                <div class="p-6 overflow-y-auto flex-1 flex flex-col gap-4">
                    @include('livewire.specialities.cabinet.form-modal-general')

                    <livewire:specialities.cabinet.form-modal-profile
                        type="Hybrid"
                        :speciality="$speciality"
                    />

                    <livewire:specialities.cabinet.form-modal-profile
                        type="Full"
                        :speciality="$speciality"
                    />

                    <livewire:specialities.cabinet.form-modal-profile
                        type="Part"
                        :speciality="$speciality"
                    />

                </div>

                <div class="border-t p-4 flex justify-end space-x-2 bg-gray-50 rounded-b-lg">
                    <button type="button" wire:click="closeModal" class="px-4 py-2 bg-gray-300 rounded text-sm hover:bg-gray-400 transition cursor-pointer">
                        Отмена
                    </button>
                    <button type="button" wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded text-sm hover:bg-blue-700 transition cursor-pointer">
                        Сохранить
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
