<div
    @class([
        "liquid-glass border-0 text-white text-sm font-semibold",
        "absolute"                  => isset($absolute),
        "inset-" . ($inset ?? 0)    => isset($inset),
        "inset-x-" . ($insetX ?? 0) => !isset($inset) && isset($insetX),
        "inset-y-" . ($insetY ?? 0) => !isset($inset) && isset($insetY),
        "top-" . ($top ?? 0)        => !isset($inset) && !isset($insetY) && (isset($top) || !isset($bottom)),
        "bottom-" . ($bottom ?? 0)  => !isset($inset) && !isset($insetY) && isset($bottom),
        "left-" . ($left ?? 0)      => !isset($inset) && !isset($insetX) && (isset($left) || !isset($right)),
        "right-" . ($right ?? 0)    => !isset($inset) && !isset($insetX) && isset($right),
        "px-". ($px ?? 5)           => !isset($p),
        "py-". ($py ?? 3)           => !isset($p),
        "p-". ($p ?? 0)             => isset($p),
        "w-". ($width ?? 'auto')    => isset($width),
        'bg-black/25',
    ])
>
    <div class="liquid-glass--bend "></div>
    <div class="liquid-glass--face"></div>
    <div class="liquid-glass--edge"></div>
    <div class="liquid-glass__menus"></div>
    <div class="liquid-glass__content h-full">
        <div class="flex lg:flex-col items-center lg:items-start justify-between gap-5 h-full">
            <span class="relative z-10 font-bold text-shadow-md text-shadow-black">
                {!! $slot ?? '' !!}
            </span>
        </div>
    </div>
</div>
