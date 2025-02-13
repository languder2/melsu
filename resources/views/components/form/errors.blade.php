@if($errors->any())
    <div
        @class([
            'border border-l-4 border-l-red-700 px-3 py-2 rounded-md',
            isset($box)?"mb-4 max-w-[1200px] mx-auto":"my-4"
        ])
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

