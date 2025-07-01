<h4 class="font-semibold mt-4 -mb-2">
    {{ __('info.caption.dormitories') }}
</h4>
<table>
    <tr class="top-9 sticky">
        <td class="p-4 bg-red text-white content-center">
            {{ __('info.dormitories.row-name') }}
        </td>
        <td class="p-4 bg-red text-white content-center">
            {{ __('info.dormitories.dormitories') }}
        </td>
        <td class="p-4 bg-red text-white content-center">
            {{ __('info.dormitories.boarding') }}
        </td>
    </tr>

    <tr class="bg-white">
        <td class="p-4 border-b">
            {{ __('info.dormitories.numbers') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryNumbers->prop ?? null }}">
            {!! $dormitoryNumbers->value !!}
        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingNumbers->prop ?? null }}">
            {!! $boardingNumbers->value !!}
        </td>
    </tr>

    <tr class="bg-white/50">
        <td class="p-4 border-b">
            {{ __('info.dormitories.places') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryPlaces->prop ?? null }}">
            {!! $dormitoryPlaces->value !!}
        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingPlaces->prop ?? null }}">
            {!! $boardingPlaces->value !!}
        </td>
    </tr>

    <tr class="bg-white">
        <td class="p-4 border-b">
            {{ __('info.dormitories.placesForDisabilities') }}
        </td>
        <td class="p-4 border-b" itemprop="{{ $dormitoryPlacesForDisabilities->prop ?? null }}">
            {!! $dormitoryPlacesForDisabilities->value !!}
        </td>
        <td class="p-4 border-b" itemprop="{{ $boardingPlacesForDisabilities->prop ?? null }}">
            {!! $boardingPlacesForDisabilities->value !!}
        </td>
    </tr>
</table>
