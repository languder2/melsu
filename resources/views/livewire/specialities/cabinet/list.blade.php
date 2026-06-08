<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use App\Models\Education\Speciality;
use App\Models\Division\Division;
use App\Enums\EducationLevel;

new class extends Component {

    public ?Division $division = null;

    #[Url]
    public string $search = '';

    #[Url]
    public string $level = '';

    public function rendering(\Illuminate\View\View $view): void
    {
        $view->layout('layouts.cabinet');
    }

    public function with(): array
    {
        $searchString = trim($this->search);

        $query = $this->division ? $this->division->specialities() : Speciality::query();

        $specialities = $query->orderBy('name')
            ->when($searchString, function ($query) use ($searchString) {
                $query->where(function ($subQuery) use ($searchString) {
                    $subQuery->where('spec_code', 'like', '%' . $searchString . '%')
                        ->orWhere('name', 'like', '%' . $searchString . '%')
                        ->orWhere('name_profile', 'like', '%' . $searchString . '%')
                        ->orWhere('id', $searchString);
                });
            })
            ->when($this->level, function ($query) {
                $query->where('level', $this->level);
            })
            ->get();

        return [
            'specialities' => $specialities,
            'educationLevels' => EducationLevel::cases(),
        ];
    }

    #[On('refresh-specialities')]
    public function refreshSpecialities(): void{}

};
?>

<div class="flex flex-col gap-3" x-data="{ notification: null }" @notify.window="notification = $event.detail; setTimeout(() => notification = null, 3000)">
    @if($division)
        <div class="-mb-3">
            @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent
        </div>
    @else
        <div class="p-3 rounded-sm shadow bg-white font-medium text-2xl">
            Направления подготовки
        </div>
    @endif

    <div x-show="notification"
         x-transition
         class="fixed bottom-5 right-5 z-50 bg-green-600 text-white px-4 py-3 rounded shadow-lg flex items-center gap-2"
         style="display: none;">
        <span x-html="notification"></span>
    </div>

    <div class="bg-white shadow px-3 pt-1 pb-2 rounded-sm flex gap-4 items-end">
        <div class="flex-1">
            <x-form.input
                wire:key="search-field"
                wire:model.live.debounce.300ms="search"
                label="Поиск по имени..."
            />
        </div>

        @if(!empty($educationLevels))
            <div class="w-64">
                <label for="level-filter" class="block text-sm font-medium text-gray-700 mb-1">Уровень образования</label>
                <select
                    id="level-filter"
                    wire:model.live="level"
                    class="w-full rounded-sm border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs focus:border-sky-500 focus:outline-hidden focus:ring-1 focus:ring-sky-500"
                >
                    <option value="">Все уровни</option>
                    @foreach($educationLevels as $enumOption)
                        <option value="{{ $enumOption->value }}">{{ $enumOption->label() }}</option>
                    @endforeach
                </select>
            </div>
        @endif
    </div>

    <div class="grid grid-cols-[auto_1fr_auto_auto] gap-x-4 gap-y-3 bg-white p-4 shadow rounded-sm">
        @forelse($specialities as $speciality)
            <div wire:key="staff-row-{{ $speciality->id }}" class="grid grid-cols-subgrid col-span-full border-b border-gray-100 pb-2 last:border-0">
                <div class="text-center font-mono text-gray-400">
                    #{{ $speciality->id }}
                </div>

                <div class="font-medium text-gray-900">
                    <a href="{{ $speciality->link }}" target="_blank" class="hover:underline hover:underline-offset-2">
                        {{ $speciality->spec_code }} {{ $speciality->name }}.
                    </a>

                    @if($speciality->name_profile)
                        <br>
                        <a href="{{ $speciality->link }}" target="_blank" class="hover:underline hover:underline-offset-2">
                            <span class="font-mono text-gray-400">Профиль:</span>
                            {{ $speciality->name_profile }}.
                        </a>
                    @endif
                </div>

                <div class="justify-self-end">
                    <button type="button" wire:click="$dispatch('open-edit-modal', { id: {{ $speciality->id }} })" class="text-sky-950 hover:text-sky-700 text-sm font-medium cursor-pointer">
                        <x-lucide-clipboard-edit class="w-6" />
                    </button>
                </div>

                <div class="justify-self-end">
                    <button type="button" wire:click="$dispatch('open-delete-modal', { id: {{ $speciality->id }} })" class="text-red-950 hover:text-red-700 text-sm font-medium cursor-pointer outline-none">
                        <x-lucide-trash-2 class="w-6" />
                    </button>
                </div>

                <div class="col-span-full flex gap-2 flex-wrap mt-1 pl-8">
                    @foreach($speciality->divisions() as $item)
                        <a href="{{ route('division.cabinet.specialities', $item) }}" class="inline-flex items-center gap-1 text-xs {{ $division->id === $item->id ? 'bg-sky-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }} px-2 py-0.5 rounded-sm">
                            #{{ $item->id }} {{ $item->name }}
                        </a>
                    @endforeach

                    <button
                        type="button"
                        wire:click="$set('level', '{{ $speciality->level->value }}')"
                        class="cursor-pointer inline-flex items-center gap-1 text-xs px-2 py-0.5 rounded-sm transition {{ $this->level === $speciality->level->value ? 'bg-sky-600 text-white' : 'bg-gray-100 text-gray-800 hover:bg-gray-200' }}"
                    >
                        {{ $speciality->level->label() }}
                    </button>
                </div>
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-4">
                Направления подготовки не найдены
            </div>
        @endforelse
    </div>

    <livewire:cabinet.modal.delete />
    <livewire:staffs.cabinet.form-modal wire:key="global-staff-edit-modal" />
</div>
