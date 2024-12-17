@if(count($errors->all()))
    <div class="border border-l-4 border-l-red-700 px-3 py-2 rounded-md">
        @foreach ($errors->all() as $message)
            <div>
                {!! $message !!}
            </div>
        @endforeach
    </div>
@endif
