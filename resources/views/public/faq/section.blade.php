@if($list->count())
    <h2 class="font-bold text-3xl">
        {{$slot}}
    </h2>

    <div class="flex flex-col gap-4">
        @foreach($list as $faq)
            <div class="bg-white">
                <div class='accordion-group grid grid-cols-1 gap-1' data-accordion="default-accordion">
                    <div class='accordion-box accordion p-6'>
                        <div
                            class='cursor-pointer text-base-red font-semibold text-lg flex justify-center items-center'
                            onclick="PublicAction.toggleShowBlock('faq_{{$faq->id}}')"
                        >
                        <span class="flex-1">
                            {!! $faq->question !!}
                        </span>
                            <svg
                                class='mx-4'
                                width='22' height='22' viewBox='0 0 22 22' fill='none' xmlns='http://www.w3.org/2000/svg'>
                                <path
                                    d='M16.5 8.25L12.4142 12.3358C11.7475 13.0025 11.4142 13.3358 11 13.3358C10.5858 13.3358 10.2525 13.0025 9.58579 12.3358L5.5 8.25'
                                    stroke='currentColor' stroke-width='1.6' stroke-linecap='round'
                                    stroke-linejoin='round'></path>
                            </svg>
                        </div>
                        <div id="faq_{{$faq->id}}"  class='overflow-hidden text-md transition-all duration-400' style="max-height: 0;">
                            <div class="pt-6">
                                {!! $faq->answer !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
