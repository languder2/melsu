<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Attributes\Locked;
use App\Models\Education\Speciality;
use App\Models\Division\Division;

new class extends Component {

    #[Locked]
    public ?Division $division = null;

    #[Url]
    public string $search = '';

    #[Url]
    public string $level = '';

    #[Url]
    public string $form = '';

    #[Url]
    public ?int $is_show = null;

    public function rendering(\Illuminate\View\View $view): void
    {
        $view->layout('layouts.cabinet');
    }

    public function with(): array
    {
        $searchString = trim($this->search);

        $query = $this->division ? $this->division->allSpecialities() : Speciality::query();

        $specialities = $query->orderBy('name')
            ->when($searchString, function ($query) use ($searchString) {
                $query->where(function ($subQuery) use ($searchString) {
                    $subQuery->where('name', 'like', '%' . $searchString . '%')
                        ->orWhere('name_profile', 'like', '%' . $searchString . '%')
                        ->orWhere('spec_code', $searchString)
                        ->orWhere('id', $searchString);
                });
            })
            ->when($this->level, function ($query) {
                $query->where('level', $this->level);
            })
            ->when($this->form, function ($query) {
                $query->whereHas('recruitmentProfiles', function ($subQuery) {
                    $subQuery->where('form', $this->form);
                });
            })
            ->when(!is_null($this->is_show), function ($query) {
                if($this->is_show === 3)
                    $query->onlyTrashed();
                else
                    $query->where('show',$this->is_show);
            })
            ->get();

        return [
            'specialities' => $specialities,
        ];
    }

    #[On('refresh-specialities')]
    public function refreshSpecialities(): void{}

};
?>

<div class="flex flex-col gap-3"
     x-data="{ notification: null }"
     @notify.window="notification = $event.detail; setTimeout(() => notification = null, 3000)"
>

    @include('livewire.cabinet.modal.notification')

    @if($division)
        <div class="-mb-3">
            @component('divisions.cabinet.item', ['division' => $division, 'has_menu' => true])@endcomponent
        </div>
    @else
        <div class="p-3 flex justify-between items-center rounded-sm shadow bg-white">
            <h3 class="font-medium text-2xl">
                Направления подготовки
            </h3>
            <div>
                <button type="button"
                        wire:click="$dispatch('open-edit-modal', { id: null })"
                        class="text-sky-950 hover:text-sky-700 text-sm font-medium cursor-pointer"
                >
                    <x-lucide-plus-square class="w-6" />
                </button>

            </div>
        </div>
    @endif

    @include('livewire.specialities.cabinet.filter')

    <div class="grid grid-cols-[auto_1fr_auto_auto] gap-x-4 gap-y-3 bg-white p-4 shadow rounded-sm">
        @forelse($specialities as $speciality)
            <div wire:key="staff-row-{{ $speciality->id }}"
                 class="grid grid-cols-subgrid col-span-full border-b border-gray-100 pb-2 last:border-0"
            >
                <div class="col-span-full flex gap-2 flex-wrap mt-1 pl-8">
                </div>


                <div class="text-center font-mono {{ $speciality->show ? 'text-gray-400' : 'text-red-700' }}">
                    #{{ $speciality->id }}
                </div>

                <div class="font-medium text-gray-900">
                    <a href="{{ $speciality->link }}" target="_blank" class="hover:underline hover:underline-offset-2">
                        {{ $speciality->spec_code }} {{ $speciality->name }}
                    </a>

                    @if($speciality->name_profile)
                        <br>
                        <a href="{{ $speciality->link }}" target="_blank" class="hover:underline hover:underline-offset-2">
                            <span class="font-mono text-gray-400">Профиль:</span>
                            {{ $speciality->name_profile }}
                        </a>
                    @endif
                </div>

                <div class="justify-self-end">
                    <button type="button"
                            wire:click="$dispatch('open-edit-modal', { id: {{ $speciality->id }} })"
                            class="text-sky-950 hover:text-sky-700 text-sm font-medium cursor-pointer"
                    >
                        <x-lucide-clipboard-edit class="w-6" />
                    </button>
                </div>

                @if($speciality->trashed())
                    <div class="justify-self-end">
                        <button type="button"
                                wire:click="$dispatch('open-delete-modal', { id: {{ $speciality->id }} })"
                                class="text-red-950 hover:text-red-700 text-sm font-medium cursor-pointer outline-none"
                        >
                            <x-lucide-rotate-ccw-square class="w-6" />
                        </button>
                    </div>
                @else
                    <div class="justify-self-end">
                        <button type="button"
                                wire:click="$dispatch('open-delete-modal', { id: {{ $speciality->id }} })"
                                class="text-red-950 hover:text-red-700 text-sm font-medium cursor-pointer outline-none"
                        >
                            <x-lucide-trash-2 class="w-6" />
                        </button>
                    </div>
                @endif

                @include('livewire.specialities.cabinet.tags')

            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-4">
                Направления подготовки не найдены
            </div>
        @endforelse
    </div>

    <livewire:cabinet.modal.delete />
    <livewire:specialities.cabinet.form-modal wire:key="speciality-edit-modal" />
</div>
