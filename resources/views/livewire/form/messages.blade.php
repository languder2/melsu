<?php

use function Livewire\Volt\{state};

state([
    'withUser'  => false,
    'forUser'   => fn() => session('forUser'),
    'messages'  => fn() => collect(session()->get('message', [])),
]);

?>
<div class="flex flex-col gap-3 {{ $messages->isEmpty() ? 'hidden' : ''  }}">
    @foreach($messages as $message)
        <div class="flex gap-3 bg-white p-3 justify-between sticky top-0 z-50 shadow border-s-3 border-s-green-700">

            @if($withUser)
                {{ $forUser }}:
            @endif

            {{ $message }}
        </div>
    @endforeach
</div>
