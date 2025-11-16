
@if($errors->any())
    <div
        class="border-l-4 border-red-700 p-3 ps-4 bg-white shadow rounded-sm"
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
