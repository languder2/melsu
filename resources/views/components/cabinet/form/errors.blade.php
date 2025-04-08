@if($errors->any())
    <div
        class="px-4 py-3 rounded-md bg-red text-white"
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
