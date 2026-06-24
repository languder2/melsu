<?php
use App\Enums\EducationLevel;
use App\Enums\EducationForm;
?>
<div class="bg-white shadow px-3 pt-1 pb-2 rounded-sm flex gap-4 items-end">
    <div class="flex-1">
        <x-form.input
            wire:key="search-field"
            wire:model.live.debounce.100ms="search"
            label="Поиск по имени..."
        />
    </div>

    <select
        id="show-filter"
        wire:model.live="is_show"
        class="
            w-50 rounded-sm border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs
            focus:border-sky-500 focus:outline-hidden focus:ring-1 focus:ring-sky-500
        "
    >
        <option value="">Активные</option>
        <option value="1">
            Опубликованные
        </option>
        <option value="0">
            Скрытые
        </option>
        <option value="3">
            Удаленные
        </option>
    </select>

    <select
        id="form-filter"
        wire:model.live="form"
        class="
            w-40 rounded-sm border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs
            focus:border-sky-500 focus:outline-hidden focus:ring-1 focus:ring-sky-500
        "
    >
        <option value="">Все формы</option>
        @foreach(EducationForm::cases() as $item)
            <option value="{{ $item->value }}">
                {{ $item->label() }}
            </option>
        @endforeach
    </select>

    <select
        id="level-filter"
        wire:model.live="level"
        class="
            w-40 rounded-sm border border-gray-300 bg-white px-3 py-2 text-sm shadow-xs
            focus:border-sky-500 focus:outline-hidden focus:ring-1 focus:ring-sky-500
        "
    >
        <option value="">Все уровни</option>
        @foreach(EducationLevel::cases() as $item)
            <option value="{{ $item->value }}">{{ $item->label() }}</option>
        @endforeach
    </select>
</div>
