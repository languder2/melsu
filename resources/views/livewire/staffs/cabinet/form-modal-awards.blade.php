<?php

use Livewire\Volt\Component;
use App\Models\Staff\Staff;
use App\Models\Staff\Award;
use Illuminate\Support\Str;
use Livewire\Attributes\On;

new class extends Component {
    public Staff $staff;

    public array $awards = [];
    public array $idsToDelete = [];

    protected function rules(): array
    {
        return [
            'awards' => 'array',
            'awards.*.id' => 'nullable|integer',
            'awards.*.key' => 'required|string',
            'awards.*.year' => 'nullable|integer|min:1900|max:' . date('Y'),
            'awards.*.award' => 'text',
            'awards.*.order' => 'integer',
        ];
    }

    protected function validationAttributes(): array
    {
        return [
            'awards.*.name' => 'Награда',
            'awards.*.year' => 'Год вручения',
        ];
    }

    public function mount(Staff $staff): void
    {
        $this->staff = $staff;
        $this->loadawards();
    }

    protected function loadAwards(): void
    {
        $this->staff->unsetRelation('awards');
        $dbAwards = $this->staff->awards()->orderBy('order')->get();

        $this->awards = [];

        foreach ($dbAwards as $award) {
            $arrayData = $award->toArray();
            $key = 'stored-' . $edu->id;
            $arrayData['key'] = $key;

            $this->awards[$key] = $arrayData;
        }

        if (empty($this->awards))
            $this->addAward();
    }

    public function addAward(): void
    {
        $key = 'new-' . Str::random(8);

        $this->awards[$key] = [
            'id' => null,
            'key' => $key,
            'staff_id' => $this->staff->id,
            'year' => null,
            'award' => '',
            'order' => count($this->awards),
        ];
    }

    public function removeAward(string $key): void
    {
        if (isset($this->awards[$key])) {
            if (!empty($this->awards[$key]['id']))
                $this->idsToDelete[] = $this->awards[$key]['id'];

            unset($this->awards[$key]);

            $this->updateOrder();
        }
    }

    public function moveUp(string $key): void
    {
        $keys = array_keys($this->awards);
        $currentIndex = array_search($key, $keys);

        if ($currentIndex === false || $currentIndex === 0) return;

        $prevKey = $keys[$currentIndex - 1];

        $this->swapElements($prevKey, $key);
        $this->updateOrder();
    }

    public function moveDown(string $key): void
    {
        $keys = array_keys($this->awards);
        $currentIndex = array_search($key, $keys);

        if ($currentIndex === false || $currentIndex === count($keys) - 1) return;

        $nextKey = $keys[$currentIndex + 1];

        $this->swapElements($key, $nextKey);
        $this->updateOrder();
    }

    protected function swapElements(string $key1, string $key2): void
    {
        $newArray = [];

        foreach ($this->awards as $k => $value)

            if ($k === $key1)
                $newArray[$key2] = $this->awards[$key2];

            elseif ($k === $key2)
                $newArray[$key1] = $this->awards[$key1];

            else
                $newArray[$k] = $value;

        $this->awards = $newArray;
    }

    protected function updateOrder(): void
    {
        $index = 0;
        foreach ($this->awards as $key => $award) {
            $this->awards[$key]['order'] = $index;
            $index++;
        }
    }

    #[On('trigger-education-save')]
    public function save(): void
    {
        $this->validate();

        if (!empty($this->idsToDelete)) {
            Award::destroy($this->idsToDelete);
            $this->idsToDelete = [];
        }

        foreach ($this->awards as $data) {
            $updateData = [
                'university' => $data['university'] ?: null,
                'year' => $data['year'] ?: null,
                'type' => 'Education',
                'level' => $data['level'] ?: null,
                'speciality' => $data['speciality'] ?: null,
                'is_show' => (bool)$data['is_show'],
                'order' => (int)$data['order'],
            ];

            if (!empty($data['id']))
                Award::where('id', $data['id'])->update($updateData);

            else
                $this->staff->awards()->create($updateData);
        }

        $this->loadawards();
    }
}
?>

<div class="flex flex-col h-full justify-between">
    <div class="flex-1 overflow-y-auto space-y-4 pr-1 min-h-0 pb-4">
        @php $iterator = 0; @endphp
        @foreach($awards as $key => $award)
            <div
                wire:key="award-block-{{ $key }}"
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
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"/>
                        </svg>
                    </button>
                    <button
                        type="button"
                        wire:click="moveDown('{{ $key }}')"
                        @disabled($iterator === count($awards) - 1)
                        class="p-1 rounded hover:bg-white border border-transparent hover:border-gray-200 text-gray-400 hover:text-gray-600 disabled:opacity-30 disabled:hover:bg-transparent"
                        title="Переместить ниже"
                    >
                        <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/>
                        </svg>
                    </button>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-12 gap-3 flex-1">
                    <div class="md:col-span-9 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Награда</label>
                        <input
                            type="text"
                            wire:model="awards.{{ $key }}.name"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder=""
                        >
                        @error("awards.$key.award") <span
                            class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-3 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Уровень / Степень</label>
                        <input
                            type="text"
                            wire:model="awards.{{ $key }}.level"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="Магистр, Бакалавр, Специалист"
                        >
                    </div>

                    <div class="md:col-span-9 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Специальность / Направление</label>
                        <input
                            type="text"
                            wire:model="awards.{{ $key }}.speciality"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="Например, Информационные системы"
                        >
                        @error("awards.$key.speciality") <span
                            class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-2 flex flex-col gap-1">
                        <label class="text-xs font-semibold text-gray-600">Год окончания</label>
                        <input
                            type="number"
                            wire:model="awards.{{ $key }}.year"
                            class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none bg-white"
                            placeholder="ГГГГ"
                        >
                        @error("awards.$key.year") <span
                            class="text-xs text-red-500">{{ $message }}</span> @enderror
                    </div>

                    <div class="md:col-span-1 flex items-center gap-2 pt-5">
                        <input
                            type="checkbox"
                            id="show-{{ $key }}"
                            wire:model="awards.{{ $key }}.is_show"
                            class="rounded border-gray-300 text-blue-600 focus:ring-blue-500 h-4 w-4"
                        >
                        <label for="show-{{ $key }}"
                               class="text-xs font-medium text-gray-700 cursor-pointer select-none">Показывать</label>
                    </div>
                </div>

                <button
                    type="button"
                    wire:click="removeEducation('{{ $key }}')"
                    class="p-1.5 rounded-md hover:bg-red-50 text-gray-400 hover:text-red-500 transition mt-5 shrink-0"
                    title="Удалить эту запись"
                >
                    <svg class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m4 0V4a1 1 0 00-1-1H10a1 1 0 00-1 1v3M4 7h16"/>
                    </svg>
                </button>
            </div>
            @php $iterator++; @endphp
        @endforeach
    </div>

    <div class="pt-3 border-t border-gray-100 bg-white shrink-0">
        <button
            type="button"
            wire:click="addEducation"
            class="inline-flex items-center gap-1.5 text-xs font-semibold text-blue-600 hover:text-blue-700 transition py-1"
        >
            <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"/>
            </svg>
            Добавить еще одно образование
        </button>
    </div>
</div>
