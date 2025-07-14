<div class="flex flex-col gap-3">

    @if(auth()->check())
        <div>
            <a
                href="{{ route('education-profile.document.modal',[$profileID]) }}?code={{$code}}"
                onclick="Modal.showModal(this.href); return false;"
                class="inline-block p-2 px-6 text-white bg-green-950 rounded hover:bg-green-700 mr-4 w-full"
            >
                add
            </a>
        </div>
    @endif

    @foreach($list ?? [] as $item)
        <div class="flex gap-2">
            <div class="flex-1 text-center flex gap-4">
                <div class="flex-1">
                    <a href="{{ $item->link }}" class="underline hover:text-red-700" itemprop="{{ $code }}" target="_blank">
                        {!! $item->title !!}
                    </a>
                </div>
                @if(auth()->check())
                    <p>
                        <a
                            href="{{ route('education-profile.document.modal',[$profileID,$item->id]) }}?code={{$code}}"
                            onclick="Modal.showModal(this.href); return false;"
                            class="inline-block p-2 bg-blue rounded hover:bg-blue-700"
                        >
                            <x-info.forms.icons.edit width="20px" height="20px" />
                        </a>
                    </p>
                    <p>
                        <a href="{{ $item->delete }}"
                           class="inline-block p-2 bg-red rounded hover:bg-red-700"
                        >
                            <x-info.forms.icons.delete width="20px" height="20px" />
                        </a>
                    </p>
                @endif
            </div>
        </div>
    @endforeach

</div>
