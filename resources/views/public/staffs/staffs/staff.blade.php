@if($staff->avatar->name !== 'avatar')
    <div class="mx-auto">
        <img
            src="{{$staff->avatar->thumbnail}}"
            alt="{{$staff->full_name}}"
            class="h-40"
        >
    </div>
@endif
<div class="flex flex-col justify-between flex-1">
    <div class="mb-7 lg:mb-0 sm:flex-row">
        <h3
            @class([
                "font-semibold mb-3 text-xl block text-baseRed ",
                $link?"group-hover:text-red-700 group-active:text-gray-700 group-hover:underline":''
            ])
        >
            {{$staff->full_name}}
        </h3>
        @if($staff->AffiliationPosts)
            @foreach($staff->AffiliationPosts as $post)
                <div class="py-2 border-b border-stone-200/70 w-full last:border-none">
                    {{$post->post_alt ?? $post->post}}
                </div>
            @endforeach
        @endif
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-[2fr_1fr] gap-4">
        @if($staff->address)
            <div class="mb-7 sm:mb-0">
                        <span class="text-[#4C4C4C]">
                            Адрес:
                        </span>
                <p class="font-semibold text-[#4C4C4C]">
                    {!! str_replace('!!!','<br>',$staff->address) !!}
                </p>
            </div>
        @endif
        @if($staff->phones)
            <div >
                        <span class="text-[#4C4C4C]">
                            Телефон:
                        </span>
                <p class="font-semibold text-[#4C4C4C]">
                    {{$staff->phones}}
                </p>
            </div>
        @endif
    </div>
</div>
