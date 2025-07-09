<div class="flex flex-col gap-3">

    @if(auth()->check())
        <div>
            <a
                href="{{ $addLink }}"
                onclick="Modal.showModal(this.href); return false;"
                class="inline-block p-2 px-6 text-white bg-green-950 rounded hover:bg-green-700 mr-4"
            >
                Добавить
            </a>
        </div>
    @endif

    @forelse($list as $item)
        <div class="flex gap-2">
            <div class="flex-1 text-center flex gap-4 items-center">
                <a href="{{ $item->delete }}"
                   class="inline-block p-2 bg-red rounded hover:bg-red-700"
                >
                    <x-info.forms.icons.delete width="20px" height="20px" />
                </a>
                <a href="{{ $item->link }}" class="underline hover:text-red-700" itemprop="{{ $code }}">
                    {!! $item->title !!}
                </a>
            </div>
        </div>
    @empty
        <div itemprop="{{ $code }}">
            {{ __('info.empty') }}
        </div>
    @endforelse

</div>
