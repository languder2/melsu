<div class="group bg-white p-6 sm:min-h-[257px] flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
    <a
        href="{!!url($staff->link)!!}"
        class="grid grid-cols-1 lg:grid-cols-[auto_minmax(70%,_1fr)] gap-5 min-h-[209px]"
    >
        <div class="mx-auto">
            @if($staff->avatar->name !== 'avatar')
                <img src="{!!$staff->avatar->thumbnail!!}" alt="{!!$staff->avatar->name!!}" class="max-h-60">
            @endif
        </div>
        <div class="flex flex-col justify-evenly">
            <div class="mb-7 lg:mb-2 sm:flex-row">
                <h3
                    class="
                        font-semibold
                        mb-3
                        text-xl
                        block
                        text-baseRed
                        group-hover:text-red-700
                        group-active:text-gray-700
                        group-hover:underline
                    "
                >
                    {!!$staff->full_name!!}
                </h3>

                <div class="mb-2">
                    <span class="text-red-700 text-md font-bold">Должность:</span>

                    @if($staff->AffiliationPosts)
                        @foreach($staff->AffiliationPosts as $post)
                            <span>
                                {{$post->post_alt ?? $post->post}}
                            </span>
                        @endforeach
                    @endif
                </div>

                @if($staff->title)
                    <div class="flex flex-col mb-2">
                        <div class="text-red-700 text-md font-bold">
                            Ученая степень, звание:
                        </div>
                        <div class="flex items-center">
                            {{$staff->title}}
                        </div>
                    </div>
                @endif


                @if($staff->reception_time)
                    <div class="flex flex-col mb-2">
                        <div class="text-red-700 text-md font-bold">
                            Прием по личным вопросам:
                        </div>
                        <div class="flex items-center">
                            {{$staff->reception_time}}
                        </div>
                    </div>
                @endif

                <div class="flex justify-between flex-col sm:flex-row mb-7 lg:mb-0">
                    @if($staff->address)
                        <div class="w-[100%] mb-7 sm:mb-0">
                            <span class="text-red-700 text-md font-bold">
                                Адрес:
                            </span>
                            <p class="font-semibold text-lg text-[#4C4C4C]">
                                {!! str_replace('!!!',' ',$staff->address) !!}
                            </p>
                        </div>
                    @endif

                    @if($staff->phone)
                        <div class="w-[100%]">
                            <span class="text-[#4C4C4C] text-lg">
                                Телефон:
                            </span>
                            <p class="font-semibold text-lg text-[#4C4C4C]">
                                {{$staff->phone}}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </a>
</div>
