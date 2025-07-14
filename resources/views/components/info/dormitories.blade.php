<h4 class="font-semibold mt-4 -mb-2">
    {{ __('info.caption.dormitories') }}
</h4>
<table>
    <tr class="top-0 sticky {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
        <td class="p-4">
            {{ __('info.dormitories.row-name') }}
        </td>
        <td class="p-4 border-x-1 border-x-white">
            {{ __('info.dormitories.dormitories') }}
        </td>
        <td class="p-4">
            {{ __('info.dormitories.boarding') }}
        </td>
    </tr>

    <tr class="bg-white">
        <td class="p-4 border-b">
            {{ __('info.dormitories.numbers') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryNumbers->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$dormitoryNumbers->type,$dormitoryNumbers->prop,$dormitoryNumbers->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $dormitoryNumbers->value !!}
                </a>
            @else
                {!! $dormitoryNumbers->value !!}
            @endif
        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingNumbers->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$boardingNumbers->type,$boardingNumbers->prop,$boardingNumbers->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $boardingNumbers->value !!}
                </a>
            @else
                {!! $boardingNumbers->value !!}
            @endif
        </td>
    </tr>

    <tr class="bg-white/50">
        <td class="p-4 border-b">
            {{ __('info.dormitories.places') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryPlaces->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$dormitoryPlaces->type,$dormitoryPlaces->prop,$dormitoryPlaces->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $dormitoryPlaces->value !!}
                </a>
            @else
                {!! $dormitoryPlaces->value !!}
            @endif
        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingPlaces->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$boardingPlaces->type,$boardingPlaces->prop,$boardingPlaces->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $boardingPlaces->value !!}
                </a>
            @else
                {!! $boardingPlaces->value !!}
            @endif
        </td>
    </tr>

    <tr class="bg-white">
        <td class="p-4 border-b">
            {{ __('info.dormitories.placesForDisabilities') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryPlacesForDisabilities->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$dormitoryPlacesForDisabilities->type,$dormitoryPlacesForDisabilities->prop,$dormitoryPlacesForDisabilities->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $dormitoryPlacesForDisabilities->value !!}
                </a>
            @else
                {!! $dormitoryPlacesForDisabilities->value !!}
            @endif

        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingPlacesForDisabilities->prop ?? null }}">
            @if(auth()->check())
                <a
                    href="{{ route('info:form',[$boardingPlacesForDisabilities->type,$boardingPlacesForDisabilities->prop,$boardingPlacesForDisabilities->id]) }}"
                    onclick="Modal.showModal(this.href); return false;" class="underline hover:text-blue"
                >
                    {!! $boardingPlacesForDisabilities->value !!}
                </a>
            @else
                {!! $boardingPlacesForDisabilities->value !!}
            @endif
        </td>
    </tr>
</table>
