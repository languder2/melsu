@if($value)
    <a href="#"
       onclick="document.getElementById('{{ $prop.$id }}').classList.toggle('hidden'); return false;"
       class="underline hover:text-blue-700"
    >
        показать/скрыть
    </a>
    <div class="hidden pt-2" id="{{ $prop.$id }}" >
        <div class="flex flex-col gap-y-3" itemprop="{{ $prop }}">
            @php $values = explode(';', $value) @endphp
            @foreach($values as $value)
                <div>
                    {!! $value.";" !!}
                </div>
            @endforeach
        </div>
    </div>
@else
    <div itemprop="{{ $prop }}">
        {!! __('info.empty') !!}
    </div>
@endif
