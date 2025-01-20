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
    <span class="text-baseRed">
        {{@$text}}
    </span>
@endif
