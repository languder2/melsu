<div
    class="
        flex items-center justify-center h-full w-full
        text-white
{{--        bg-[image:var({{ auth()->check() ? "--bg-cabinet-header" : "--bg-sveden-header" }})]--}}
    "
    style="background-image: url({{ auth()->check() ? asset("img/cabinet/bg-header.png") : asset("img/sveden/bg-sved.jpg") }})"
>
    &copy; 2025 ФГБОУ ВО "МелГУ"
</div>

