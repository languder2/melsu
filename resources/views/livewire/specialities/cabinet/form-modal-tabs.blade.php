<div class="flex border-b border-gray-200 bg-gray-50 px-6 gap-2">
    <button
        type="button"
        @click="activeTab = 'general'"
        :class="activeTab === 'general' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
    >
        Общие сведения
    </button>

    <button
        type="button"
        @click="activeTab = 'Full'"
        :class="activeTab === 'Full' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
    >
        Очная форма
    </button>

    <button
        type="button"
        @click="activeTab = 'Hybrid'"
        :class="activeTab === 'Hybrid' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
    >
        Очно-заочная  форма
    </button>

    <button
        type="button"
        @click="activeTab = 'Part'"
        :class="activeTab === 'Part' ? 'border-blue-600 text-blue-600 font-semibold' : 'border-transparent text-gray-500 hover:text-gray-700 hover:border-gray-300'"
        class="py-3 px-4 border-b-2 text-sm transition focus:outline-none"
    >
        Заочная форма
    </button>
</div>
