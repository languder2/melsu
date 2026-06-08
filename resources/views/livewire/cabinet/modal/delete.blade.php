<?php

use Livewire\Volt\Component;
use Livewire\Attributes\On;
use App\Models\Education\Speciality;

new class extends Component {

    public bool $isOpen = false;
    public ?Speciality $speciality;

    #[On('open-delete-modal')]
    public function openModal(int $id): void
    {
        $this->speciality = Speciality::findOrFail($id);

        $this->isOpen = true;
    }

    public function closeModal(): void
    {
        $this->isOpen = false;

        $this->reset(['speciality', 'isOpen']);

        $this->resetValidation();
    }

    public function delete(): void
    {
        if($this->speciality){
            $this->speciality->delete();

            $this->dispatch('notify', "Направление подготовки успешно удалено.<br>#{$this->speciality->id} {$this->speciality->spec_code} {$this->speciality->name}.<br>{$this->speciality->name_profile}");

            $this->closeModal();

            $this->dispatch('refresh-specialities');
        }
    }


};
?>
<div>
    @if($isOpen && $speciality)
        <div
            @keydown.escape.window="$wire.closeModal()"
            class="fixed inset-0 z-50 flex items-center justify-center overflow-y-auto bg-black/60 p-4 backdrop-blur-xs"
        >
            <div class="relative max-w-7xl rounded-lg bg-white shadow-2xl flex flex-col lg:max-h-[85vh]" wire:click.away="closeModal">
                <div class="px-6 py-4 border-b border-gray-100 flex gap-x-3 justify-between items-center">
                    <h3 class="text-lg font-bold text-gray-900">
                        Подтверждение
                    </h3>
                    <button type="button" wire:click="closeModal" class="text-gray-400 hover:text-gray-600 transition cursor-pointer">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>

                <div class="font-medium px-6 py-4 flex flex-col gap-3">
                    <div>
                        <span class="font-mono text-gray-400">
                            #{{ $speciality->id }}
                        </span>
                        {{ $speciality->spec_code }}
                        {{ $speciality->name }}.
                    </div>

                    @if($speciality->name_profile)
                        <div>
                            <span class="font-mono text-gray-400">
                                Профиль:
                            </span>
                            {{ $speciality->name_profile }}.
                        </div>
                    @endif

                    @if($speciality->divisions())
                        <hr>
                        @foreach($speciality->divisions() as $division)
                            <a href="{{ route('division.cabinet.specialities', $division) }}" class="inline-flex items-center gap-1 text-xs bg-gray-100 px-2 py-0.5 rounded-sm">
                                #{{ $division->id }}
                                {{ $division->name }}
                            </a>
                        @endforeach
                    @endif

                </div>

                <div class="flex gap-2 shrink-0 px-6 py-4 border-t border-gray-100 justify-end">
                    <button type="button" wire:click="closeModal"
                            class="px-4 py-2 text-sm font-medium text-gray-600 hover:bg-gray-200 transition rounded-md">
                        Отмена
                    </button>

                    <button type="button" wire:click="delete"
                            class="px-5 py-2 text-sm font-semibold bg-red-600 hover:bg-red-700 text-white transition rounded-md shadow-sm cursor-pointer">
                        Удалить направление подготовки
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
