@if($errors->any())
    <div
        @if(isset($setTheme) && $setTheme === '1')
            class="border border-l-4 border-l-red-700 px-3 py-2  mb-4 bg-stone-100"
        @elseif(isset($setTheme) && $setTheme === '2')
            class="border border-l-4 border-l-red-700 px-3 py-2 bg-white"
        @else
            @class([
                'border border-l-4 border-l-red-700 px-3 py-2 rounded-md',
                isset($box)?"mb-4 max-w-[1200px] mx-auto":"my-4"
            ])
        @endif
    >
        @foreach ($errors->all() as $message)
            @if (!isset($displayedErrors[$message]))
                <div>
                    {!! $message !!}
                </div>
                @php $displayedErrors[$message] = true; @endphp
            @endif
        @endforeach
    </div>
@endif
