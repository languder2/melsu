<div class="group bg-white p-6 sm:min-h-[257px] flex flex-col justify-between mb-3 last:mb-0 hover:bg-gray-100">
    <a
        href="{!!url($staff->link)!!}"
        class="grid grid-cols-1 lg:grid-cols-[auto_minmax(70%,_1fr)] gap-5 min-h-[209px]"
    >
        <div class="mx-auto">
            @if($staff->avatar->name !== 'avatar')
                <img src="{!!$staff->avatar->thumbnail!!}" alt="{!!$staff->avatar->name!!}" class="max-h-60">
            @else
                <div class="flex items-center bg-neutral-150 w-60 h-60 justify-center rounded-md">
                    <svg height="150px" viewBox="0 0 128 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M26.6455 90.9125C16.8993 96.9333 -8.6546 109.227 6.90945 124.611C14.5124 132.126 22.9801 137.5 33.626 137.5H94.374C105.02 137.5 113.488 132.126 121.091 124.611C136.655 109.227 111.101 96.9333 101.354 90.9125C78.4998 76.7939 49.5002 76.7939 26.6455 90.9125Z" stroke="#C10F1A" stroke-width="4"></path>
                        <path d="M92.1818 31.0882C92.1818 46.8771 79.5644 59.6765 64 59.6765C48.4356 59.6765 35.8182 46.8771 35.8182 31.0882C35.8182 15.2994 48.4356 2.5 64 2.5C79.5644 2.5 92.1818 15.2994 92.1818 31.0882Z" stroke="#C10F1A" stroke-width="4"></path>
                    </svg>
                </div>
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
                    <div class="text-red-700 text-md font-bold">Должность:</div>
                    <div>
                        @if($staff->AffiliationPosts)
                            @foreach($staff->AffiliationPosts as $post)
                                <span class="lg:text-nowrap">
                                {{$post->post_alt ?? $post->post}}@if(!$loop->last && $loop->count>1),@endif
                                </span>
                            @endforeach

                        @endif
                    </div>
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

                <div class="flex justify-between flex-col mb-7 gap-2 lg:mb-0">
                    @if($staff->address)
                        <div class="w-[100%] mb-7 sm:mb-0">
                            <span class="text-red-700 text-md font-bold">
                                Адрес:
                            </span>
                            <p>
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

                    @if($staff->emails)
                        <div class="w-[100%] mb-7 sm:mb-0">
                            <span class="text-red-700 text-md font-bold">
                                Email:
                            </span>
                            <p>
                                {!! $staff->emails !!}
                            </p>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </a>
</div>
