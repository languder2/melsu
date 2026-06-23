@props([
    'tabs' =>[
        'general'   => 'Общие сведения',
        'Full'      =>  'Очная форма',
        'Hybrid'    =>  'Очно-заочная форма',
        'Part'      =>  'Заочная форма',
    ],
])

<div class="flex border-b border-gray-200 bg-gray-50 px-6 gap-2">

    @foreach($tabs as $tabCode => $tabName)
        <button
            type="button"
            @click="activeTab = '{{ $tabCode }}'"
            :class="
                activeTab === '{{ $tabCode }}' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'
            "
            class="py-3 px-4 border-b-2 text-sm transition focus:outline-none cursor-pointer"
        >
            {{ $tabName }}
        </button>
    @endforeach
</div>
