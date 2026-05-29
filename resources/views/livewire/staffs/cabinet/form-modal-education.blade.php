<?php

use Livewire\Volt\Component;
use App\Models\Staff\Staff;
use App\Models\Staff\Education;
use Illuminate\Support\Str;

new class extends Component {
    public Staff $staff;

    public array $educations = [];
    public array $idsToDelete = [];

    protected function rules(): array
    {
        return [
            'educations' => 'array',
            'educations.*.id' => 'nullable|integer',
            'educations.*.key' => 'required|string',
            'educations.*.university' => 'nullable|string|max:500',
            'educations.*.year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'educations.*.type' => 'nullable|string|max:100',
            'educations.*.level' => 'nullable|string|max:100',
            'educations.*.speciality' => 'nullable|string|max:255',
            'educations.*.is_show' => 'boolean',
            'educations.*.order' => 'integer',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'educations.*.university' => 'Учебное заведение',
            'educations.*.year' => 'Год окончания',
            'educations.*.speciality' => 'Специальность',
        ];
    }

    public function mount(Staff $staff): void
    {
        $this->staff = $staff;
        $this->loadEducations();
    }

    protected function loadEducations(): void
    {
        $this->staff->unsetRelation('educations');
        $dbEducations = $this->staff->educations()->orderBy('order')->get();
        $this->educations = [];

        foreach ($dbEducations as $edu) {
            $arrayData = $edu->toArray();
            $key = 'stored-' . $edu->id;
            $arrayData['key'] = $key;

            $this->educations[$key] = $arrayData;
        }

        if (empty($this->educations))
            $this->addEducation();
    }

    public function addEducation(): void
    {
        $key = 'new-' . Str::random(8);

        $this->educations[$key] = [
            'id' => null,
            'key' => $key,
            'staff_id' => $this->staff->id,
            'university' => '',
            'year' => null,
            'type' => 'Education',
            'level' => '',
            'speciality' => '',
            'is_show' => true,
            'order' => count($this->educations),
        ];
    }

    public function removeEducation(string $key): void
    {
        if (isset($this->educations[$key])) {
            if (!empty($this->educations[$key]['id']))
                $this->idsToDelete[] = $this->educations[$key]['id'];

            unset($this->educations[$key]);

            $this->updateOrder();
        }
    }

    public function moveUp(string $key): void
    {
        $keys = array_keys($this->educations);
        $currentIndex = array_search($key, $keys);

        if ($currentIndex === false || $currentIndex === 0) return;

        $prevKey = $keys[$currentIndex - 1];

        $this->swapElements($prevKey, $key);
        $this->updateOrder();
    }

    public function moveDown(string $key): void
    {
        $keys = array_keys($this->educations);
        $currentIndex = array_search($key, $keys);

        if ($currentIndex === false || $currentIndex === count($keys) - 1) return;

        $nextKey = $keys[$currentIndex + 1];

        $this->swapElements($key, $nextKey);
        $this->updateOrder();
    }

    protected function swapElements(string $key1, string $key2): void
    {
        $newArray = [];

        foreach ($this->educations as $k => $value)

            if ($k === $key1)
                $newArray[$key2] = $this->educations[$key2];

            elseif ($k === $key2)
                $newArray[$key1] = $this->educations[$key1];

            else
                $newArray[$k] = $value;

            $this->educations = $newArray;
    }

    protected function updateOrder(): void
    {
        $index = 0;
        foreach ($this->educations as $key => $education) {
            $this->educations[$key]['order'] = $index;
            $index++;
        }
    }

    public function save(): void
    {
        $this->validate();

        if (!empty($this->idsToDelete)) {
            Education::destroy($this->idsToDelete);
            $this->idsToDelete = [];
        }

        foreach ($this->educations as $data) {
            $updateData = [
                'university' => $data['university'] ?: null,
                'year'       => $data['year'] ?: null,
                'type'       => 'Education',
                'level'      => $data['level'] ?: null,
                'speciality' => $data['speciality'] ?: null,
                'is_show'    => (bool) $data['is_show'],
                'order'      => (int) $data['order'],
            ];

            if (!empty($data['id']))
                Education::where('id', $data['id'])->update($updateData);

            else
                $this->staff->educations()->create($updateData);
        }

        $this->loadEducations();

        $this->dispatch('notify', message: 'Сведения об образовании успешно сохранены!');

        $this->dispatch('staff-updated');
    }
}
?>

<div class="flex flex-col flex-1 overflow-hidden h-full">
    <div class="flex-1 overflow-y-auto space-y-4 pr-1 mb-4">

        @php $iterator = 0; @endphp
        @foreach($educations as $key => $education)
            <div
                wire:key="edu-block-{{ $key }}"
                class="relative border border-gray-200 rounded-lg p-4 bg-gray-50/50 flex gap-4 items-start transition hover:border-gray-300"
            >
                <div class="flex flex-col gap-1 pt-6 shrink-0">
                    <button
                        type="button"
                        wire:click="moveUp('{{ $key }}')"
                        @disabled($iterator === 0)
                        class="p-1 rounded hover:bg-white border border-transparent hover:border-gray-200 text-gray-400 hover:text-gray-600 disabled:opacity-30 disabled:hover:bg-transparent"
                        title="Переместить выше"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/></svg>
                    </button>
                    <button
                        type="button"
                        wire:click="moveDown('{{ $key }}')"
                        @disabled($iterator === count($educations) - 1)
                        class="p-1 rounded hover:bg-white border border-transparent hover:border-gray-200 text-gray-400 hover:text-gray-600 disabled:opacity-30 disabled:hover:bg-transparent"
                        title="Переместить ниже"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 flex-1">

                    {{-- ВАЖНО: Вместо $index теперь везде используется оригинальный строковый $key --}}
                    <div class="md:col-span-9 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Учебное заведение</label>
                        <input
                            type="text"
                            wire:model="educations.{{ $key }}.university"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="Например, ФГБОУ ВО «МелГУ»"
                        >
                        @error("educations.{$key}.university") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-3 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Уровень / Степень</label>
                        <input
                            type="text"
                            wire:model="educations.{{ $key }}.level"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="Магистр, Бакалавр, Специалист"
                        >
                    </div>

                    <div class="md:col-span-9 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Специальность / Направление</label>
                        <input
                            type="text"
                            wire:model="educations.{{ $key }}.speciality"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="Например, Информационные системы"
                        >
                        @error("educations.{$key}.speciality") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Год окончания</label>
                        <input
                            type="number"
                            wire:model="educations.{{ $key }}.year"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="ГГГГ"
                        >
                        @error("educations.{$key}.year") <span class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-1 flex items-center gap-2 pt-5">
                        <input
                            type="checkbox"
                            id="show-{{ $key }}"
                            wire:model="educations.{{ $key }}.is_show"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-4 w-4"
                        >
                        <label for="show-{{ $key }}" class="text-xs font-medium text-gray-700 cursor-pointer select-none">Показывать</label>
                    </div>

                </div>

                <button
                    type="button"
                    wire:click="removeEducation('{{ $key }}')"
                    class="p-1.5 rounded-md hover:bg-red-50 text-gray-400 hover:text-red-500 transition mt-5 shrink-0"
                    title="Удалить эту запись"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m4 0V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                </button>

            </div>
            @php $iterator++; @endphp
        @endforeach

    </div>

    <div class="flex justify-between items-center pt-2 border-t border-gray-100">
        <button
            type="button"
            wire:click="addEducation"
            class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 transition"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Добавить еще одно образование
        </button>

        <button
            type="button"
            wire:click="save"
            class="px-4 py-1.5 text-xs font-semibold bg-sky-950 hover:bg-sky-800 cursor-pointer text-white transition rounded-md shadow-sm"
        >
            Применить список
        </button>
    </div>
</div>
