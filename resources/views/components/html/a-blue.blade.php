@if(!isset($active) || empty($active))
    <a
        href="{{@$href}}"

        class="
            text-blue-900

            hover:text-blue-700
            hover:underline

            active:text-gray-700
        "

        @if(isset($blank))
            target="_blank"
        @endif
    >
        {{@$text}}
    </a>
@else
    <a
        href="{{@$href}}"

        class="
            text-baseRed

            hover:text-red-700
            hover:underline

            active:text-gray-700
        "

        @if(isset($blank))
            target="_blank"
        @endif
    >
        {{@$text}}
    </a>
@endif
