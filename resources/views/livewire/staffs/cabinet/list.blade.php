<?php

use Livewire\Volt\Component;
use Livewire\WithPagination;
use Livewire\Attributes\Url;
use App\Models\Staff\Staff;
use Livewire\Attributes\On;

new class extends Component {
    use WithPagination;

    #[Url]
    public string $search = '';

    #[Url]
    public int $countOnPage = 20;

    public function rendering($view): void
    {
        $view->layout('layouts.cabinet');
    }

    public function updatingSearch(): void
    {
        $this->resetPage();
    }

    public function updatingCountOnPage(): void
    {
        $this->resetPage();
    }

    #[On('staff-updated')]
    public function refreshStaffList(): void
    {
    }

    public function with(): array
    {
        $searchString = trim($this->search);

        return [
            'staffs' => Staff::query()
                ->with(['posts.division'])
                ->when($searchString, function ($query) use ($searchString) {
                    $query->where(function ($subQuery) use ($searchString) {
                        $subQuery->where('lastname', 'like', '%' . $searchString . '%')
                            ->orWhere('firstname', 'like', '%' . $searchString . '%')
                            ->orWhere('middle_name', 'like', '%' . $searchString . '%')
                            ->orWhere('id', $searchString);
                    });
                })
                ->paginate((int) $this->countOnPage)
        ];
    }
};
?>

<div class="flex flex-col gap-3">
    {{ $slot }}

    <div class="bg-white shadow px-3 pt-1 pb-2 rounded-sm flex gap-4 items-end">
        <div class="flex-1">
            <x-form.input
                wire:key="search-field"
                wire:model.live.debounce.300ms="search"
                label="Поиск по имени..."
            />
        </div>

        <div>
            <select
                wire:key="count-on-page-select"
                wire:model.live="countOnPage"
                class="border-b border-gray-300 py-2 bg-transparent outline-none text-sm"
            >
                @foreach([10, 20, 50, 100] as $count)
                    <option value="{{ $count }}">{{ $count }} на странице</option>
                @endforeach
            </select>
        </div>
    </div>

    <div class="grid grid-cols-[auto_1fr_auto] gap-x-4 gap-y-3 bg-white p-4 shadow rounded-sm">
        @forelse($staffs as $staff)
            <div wire:key="staff-row-{{ $staff->id }}" class="grid grid-cols-subgrid col-span-full border-b border-gray-100 pb-2 last:border-0">
                <div class="text-center font-mono text-gray-400 pr-2">
                    #{{ $staff->id }}
                </div>
                <div>
                    <a href="{{ $staff->link }}" target="_blank" class="font-medium text-gray-900">{{ $staff->fullname }}</a>
                </div>

                <div class="justify-self-end">
                    <button
                        type="button"
                        wire:click="$dispatch('open-edit-modal', { id: {{ $staff->id }} })"
                        class="text-blue-600 hover:text-blue-800 text-sm font-medium"
                    >
                        Редактировать
                    </button>
                </div>

                @if($staff->posts->isNotEmpty())
                    <div class="col-span-full flex gap-2 flex-wrap mt-1 pl-8">
                        @foreach($staff->posts as $post)
                            <a href="{{ route('division.posts.cabinet.list', $post->division)  }}" class="inline-flex items-center gap-1 text-xs bg-gray-100 text-gray-700 px-2 py-0.5 rounded-sm">
                                <span class="font-medium">{{ $post->post }}</span>
                                    <span class="text-gray-400">
                                    (#{{ $post->division->id }} {{ $post->division->name }})
                                </span>
                            </a>
                        @endforeach
                    </div>
                @endif
            </div>
        @empty
            <div class="col-span-full text-center text-gray-400 py-4">
                Сотрудники не найдены
            </div>
        @endforelse
    </div>

    <div>
        {{ $staffs->links() }}
    </div>

    <livewire:staffs.cabinet.form-modal />
</div>
