<div x-show="activeTab === 'general'" class="grid grid-cols-1 md:grid-cols-2 gap-4">
    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Фамилия <span class="text-red-500">*</span></label>
        <input x-init="$el.focus()" type="text" wire:model="lastname" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('lastname') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Имя <span class="text-red-500">*</span></label>
        <input type="text" wire:model="firstname" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('firstname') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Отчество</label>
        <input type="text" wire:model="middle_name" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('middle_name') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Дата рождения</label>
        <input type="date" wire:model="birthday" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('birthday') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Место рождения</label>
        <input type="text" wire:model="birthplace" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('birthplace') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Место жительства</label>
        <input type="text" wire:model="residence" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('residence') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Семейный статус</label>
        <input type="text" wire:model="family_status" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('family_status') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Принадлежность / Членство</label>
        <input type="text" wire:model="affiliation" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('affiliation') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div class="col-span-full">
        <label class="block text-xs font-semibold text-gray-700 mb-1">Фактический адрес</label>
        <input type="text" wire:model="address" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('address') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Время приема</label>
        <input type="text" wire:model="reception_time" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('reception_time') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Алиас (латиница)</label>
        <input type="text" wire:model="alias" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none">
        @error('alias') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Телефоны (через запятую)</label>
        <input type="text" wire:model="phones" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none" placeholder="+79991112233, +79994445566">
        @error('phones') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>

    <div>
        <label class="block text-xs font-semibold text-gray-700 mb-1">Email-адреса (через запятую)</label>
        <input type="text" wire:model="emails" class="w-full rounded border border-gray-300 px-3 py-1.5 text-sm focus:border-blue-500 outline-none" placeholder="work@mail.ru, personal@mail.ru">
        @error('emails') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
    </div>
</div>
