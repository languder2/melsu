<div class="flex flex-col gap-3">

    @if(auth()->check())
        <div>
            <a
                href="{{ $addLink }}"
                onclick="Modal.showModal(this.href); return false;"
                class="inline-block p-2 px-6 text-white bg-green-950 rounded hover:bg-green-700 mr-4"
            >
                Добавить файл
            </a>
        </div>
    @endif

    @forelse($list as $item)
        <div class="flex gap-2">
            <div class="flex-1 text-center flex gap-4 items-center">
                <div class="flex-1">
                    <a href="{{ $item->link }}" class="underline hover:text-red-700" itemprop="{{ $code }}" target="_blank">
                        {!! $item->title !!}
                    </a>
                </div>
                <a
                    href="{{ $item->edit }}"
                    onclick="Modal.showModal(this.href); return false;"
                    class="inline-block p-2 bg-blue rounded hover:bg-blue-700"
                >
                    <x-info.forms.icons.edit width="20px" height="20px" />
                </a>
                <a href="{{ $item->delete }}"
                   class="inline-block p-2 bg-red rounded hover:bg-red-700"
                >
                    <x-info.forms.icons.delete width="20px" height="20px" />
                </a>
            </div>
        </div>
    @empty
        <div itemprop="{{ $code }}">
            {{ __('info.empty') }}
        </div>
    @endforelse

</div>
