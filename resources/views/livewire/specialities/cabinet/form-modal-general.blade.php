<div x-show="activeTab === 'general'" class="flex flex-col gap-3">
    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">
            Код направления<span class="text-red-500">*</span>
        </label>
        <input x-init="$el.focus()" type="text" wire:model="spec_code" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none" required>
        @error('spec_code') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">
            Направление подготовки<span class="text-red-500">*</span>
        </label>
        <input type="text" wire:model="name" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none" required>
        @error('name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">
            Профиль подготовки
        </label>
        <input type="text" wire:model="name_profile" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('name_profile') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div
        wire:ignore
        x-data="{ currentDeptId: @entangle('department_id') }"
        x-init="
                            $( $refs.select2Elem ).select2({
                                placeholder: 'Выбрать кафедру',
                                allowClear: true
                            }).on('change', function (e) {
                                let val = e.target.value;
                                currentDeptId = val === '' ? null : parseInt(val);
                            });

                            $watch('currentDeptId', value => {
                                $( $refs.select2Elem ).val(value === null ? '' : value).trigger('change.select2');
                            });
                        "
    >
        <label class="block text-xs font-semibold text-gray-700 mb-1">Кафедра</label>
        <select
            x-ref="select2Elem"
            class="jq-select2"
            name="department_id"
            style="width: 100%"
        >
            <option value=""></option>
            <option value="null" @selected($department_id === null)>Без привязки к кафедре</option>

            @foreach($divisions as $id => $division)
                <option value="{{ $id }}" @selected($department_id === $id)>
                    #{{ $id }} {!! $division !!}
                </option>
            @endforeach
        </select>
        @error('department_id') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">
            Уровень обучения
        </label>
        <select
            wire:model="level"
            id="level"
            class="w-full p-3 rounded-sm border border-gray-400 cursor-pointer outline-none"
        >
            @foreach(\App\Enums\EducationLevel::getList() as $id=>$value)
                <option value="{{ $id }}">{{ $value }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">
            Alias (Code)
        </label>
        <input type="text" wire:model="code" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none" required>
        @error('code') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div class="flex items-center mt-2">
        <label class="relative inline-flex items-center cursor-pointer select-none gap-2">
            <input
                type="checkbox"
                wire:model="show"
                class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 focus:ring-2 accent-blue-600 cursor-pointer"
            >
            <span class="text-sm font-semibold text-gray-700">Отображать на сайте</span>
        </label>
        @error('show') <span class="text-xs text-red-500 ml-2 block">{{ $message }}</span> @enderror
    </div>
</div>
