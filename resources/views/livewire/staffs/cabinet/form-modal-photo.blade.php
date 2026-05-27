<div x-show="activeTab === 'photo'" class="flex flex-col h-full max-h-full min-h-0 w-full">

    <div
        class="relative flex flex-col items-center justify-center border-2 border-dashed rounded-lg p-6 box-border transition-all duration-200 min-h-0 h-full max-h-full w-full overflow-hidden"
        :class="isDragging ? 'border-blue-500 bg-blue-50/50' : 'border-gray-300 hover:border-blue-400 bg-gray-50/50'"
    >
        <input
            type="file"
            x-ref="fileInput"
            wire:model="photoFile"
            class="hidden"
            accept="image/*"
        >

        <div wire:loading wire:target="photoFile" class="absolute inset-0 bg-white/90 z-10 flex items-center justify-center rounded-lg">
            <div class="flex flex-col items-center gap-2">
                <svg class="animate-spin h-8 w-8 text-blue-600" fill="none" viewBox="0 0 24 24">
                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                </svg>
                <span class="text-xs font-semibold text-gray-600">Загрузка изображения...</span>
            </div>
        </div>

        @if ($photoFile || $avatar)
            <div class="flex flex-col items-center justify-between gap-3 h-full max-h-full flex-1 min-h-0 overflow-hidden w-full">

                <div
                    @click="$refs.fileInput.click()"
                    class="group relative rounded-lg overflow-hidden border border-gray-200 shadow-sm bg-gray-50 flex-1 min-h-0 w-full max-h-full flex items-center justify-center cursor-pointer select-none"
                    title="Кликните, чтобы изменить фото"
                >
                    @if ($photoFile)
                        <img src="{{ $photoFile->temporaryUrl() }}" class="max-h-full max-w-full object-contain block m-auto transition duration-200 group-hover:scale-[1.02]">
                    @elseif ($avatar)
                        <img src="{{ Storage::url($avatar) }}" class="max-h-full max-w-full object-contain block m-auto transition duration-200 group-hover:scale-[1.02]">
                    @endif

                    <div class="absolute inset-0 bg-black/40 opacity-0 group-hover:opacity-100 transition duration-200 flex flex-col items-center justify-center gap-2 text-white">
                        <svg class="h-8 w-8 text-white drop-shadow-sm" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 1121.253 8H18" />
                        </svg>
                        <span class="text-xs font-medium bg-black/50 px-2 py-1 rounded-md backdrop-blur-xs">Заменить фото</span>
                    </div>
                </div>

                <button
                    type="button"
                    wire:click="deletePhoto"
                    class="flex-shrink-0 inline-flex items-center gap-1.5 text-xs font-semibold text-red-600 hover:text-red-800 transition bg-red-50 hover:bg-red-100 px-3 py-1.5 rounded-md"
                >
                    <svg class="h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                    </svg>
                        {{ $photoFile ? "Отменить загрузку" : 'Удалить фото' }}
                </button>
            </div>
        @else
            <div
                @click="$refs.fileInput.click()"
                class="cursor-pointer flex flex-col items-center justify-center text-center gap-2 w-full h-full py-4"
            >
                <div class="p-3 bg-white rounded-full shadow-xs border border-gray-200 text-gray-400">
                    <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="text-xs text-gray-600">
                    <span class="font-semibold text-blue-600 hover:text-blue-700">Выберите файл</span> или перетащите его сюда
                </div>
                <div class="text-[10px] text-gray-400">PNG, JPG, JPEG до 5MB</div>
            </div>
        @endif
    </div>
</div>

@error('photoFile') <span class="text-xs text-red-500 mt-1 block">{{ $message }}</span> @enderror
