<section id="news-block" class="news-section scroll-mt-[50px] lg:scroll-mt-[150px] xl:scroll-mt-[200px]">
    <div class="container custom p-0">
        @if($news->count())

            <div class="flex justify-between items-center my-6 flex-row">
                <div>
                    <h2 class="text-2xl lg:text-3xl font-bold px-2.5 2xl:px-0">Новости</h2>
                </div>
                <div class="border-b-0 sm:border-r-4 sm:border-red-900 sm:border-b-4 sm:border-b-[#FAFAFA] px-3 transition duration-300 ease-linear cursor-pointer
        hover:border-b-4 hover:border-red-900">
                    <a href="{{url(route('news:show:all'))}}" class="font-semibold">Все новости</a>
                </div>
            </div>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
                @foreach($news as $k => $item)
                    <a class="flex flex-col relative group {{$k == 0 ? 'bg-[#252525]' : 'bg-white'}}"
                        href="{{$item->link}}" alt="{{$item->title}}">
                        <div class="h-[180px] 2xl:h-[210px] mb-5">
                            <img src="{{$item->preview->thumbnail}}" alt="" class="object-cover object-top h-full w-full transition duration-300 ease-linear group-hover:opacity-80">
                        </div>
                        <div class="px-5 pb-5 flex flex-col justify-between gap-5 h-full">
                            <div class="">
                                <span class="{{$k == 0 ? 'text-white' : ''}} font-bold text-lg 2xl:text-xl">{{$item->title}}</span>
                            </div>
                            <div class="flex items-center gap-2">
                                @if($k == 0)
                                    <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.6446 10.6212C22.5776 10.6212 24.9552 8.24359 24.9552 5.31061C24.9552 2.37764 22.5776 0 19.6446 0C16.7116 0 14.334 2.37764 14.334 5.31061C14.334 8.24359 16.7116 10.6212 19.6446 10.6212Z" fill="url(#paint0_linear_6430_12787)"/>
                                        <path d="M5.31061 10.6212C8.24359 10.6212 10.6212 8.24359 10.6212 5.31061C10.6212 2.37764 8.24359 0 5.31061 0C2.37764 0 0 2.37764 0 5.31061C0 8.24359 2.37764 10.6212 5.31061 10.6212Z" fill="url(#paint1_linear_6430_12787)"/>
                                        <path data-figma-bg-blur-radius="18" d="M12.4753 2.74146C17.2127 2.7415 21.0525 6.58118 21.0525 11.3186C21.0525 13.645 20.1257 15.753 18.6208 17.2991L18.1345 17.7991L18.4353 18.428L19.3992 20.4465C19.5445 20.7516 19.4156 21.1124 19.116 21.2561C18.8107 21.4015 18.4499 21.2721 18.3064 20.9719H18.3054L17.5955 19.4866L17.1599 18.5745L16.2527 19.0208C15.1123 19.5816 13.8321 19.8977 12.4753 19.8977C11.1185 19.8977 9.83839 19.5816 8.698 19.0208L7.79077 18.5745L7.35425 19.4866L6.64526 20.97C6.51759 21.2357 6.22409 21.3659 5.95093 21.2981L5.83569 21.2571C5.57078 21.129 5.44156 20.8355 5.50952 20.5627L5.55054 20.4475L6.51538 18.428L6.81616 17.7991L6.32983 17.2991C4.82496 15.753 3.89822 13.6451 3.89819 11.3186C3.89819 6.58116 7.7379 2.74146 12.4753 2.74146Z" fill="url(#paint2_linear_6430_12787)" stroke="url(#paint3_linear_6430_12787)" stroke-width="2"/>
                                        <path d="M13.2583 5.5089C13.2583 5.07062 12.903 4.71533 12.4647 4.71533C12.0264 4.71533 11.6711 5.07062 11.6711 5.5089V11.4752C11.6711 11.9135 12.0264 12.2688 12.4647 12.2688C12.903 12.2688 13.2583 11.9135 13.2583 11.4752V5.5089Z" fill="white"/>
                                        <path d="M16.153 12.271C16.5912 12.271 16.9465 11.9157 16.9465 11.4774C16.9465 11.0391 16.5912 10.6838 16.153 10.6838H12.4671C12.0288 10.6838 11.6735 11.0391 11.6735 11.4774C11.6735 11.9157 12.0288 12.271 12.4671 12.271H16.153Z" fill="white"/>
                                        <defs>
                                        <clipPath id="bgblur_0_6430_12787_clip_path" transform="translate(15.1018 16.2585)"><path d="M12.4753 2.74146C17.2127 2.7415 21.0525 6.58118 21.0525 11.3186C21.0525 13.645 20.1257 15.753 18.6208 17.2991L18.1345 17.7991L18.4353 18.428L19.3992 20.4465C19.5445 20.7516 19.4156 21.1124 19.116 21.2561C18.8107 21.4015 18.4499 21.2721 18.3064 20.9719H18.3054L17.5955 19.4866L17.1599 18.5745L16.2527 19.0208C15.1123 19.5816 13.8321 19.8977 12.4753 19.8977C11.1185 19.8977 9.83839 19.5816 8.698 19.0208L7.79077 18.5745L7.35425 19.4866L6.64526 20.97C6.51759 21.2357 6.22409 21.3659 5.95093 21.2981L5.83569 21.2571C5.57078 21.129 5.44156 20.8355 5.50952 20.5627L5.55054 20.4475L6.51538 18.428L6.81616 17.7991L6.32983 17.2991C4.82496 15.753 3.89822 13.6451 3.89819 11.3186C3.89819 6.58116 7.7379 2.74146 12.4753 2.74146Z"/>
                                        </clipPath><linearGradient id="paint0_linear_6430_12787" x1="0.964519" y1="9.10928" x2="26.1247" y2="3.99288" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3B3BF9"/>
                                        <stop offset="0.51" stop-color="#10E0F9"/>
                                        <stop offset="1" stop-color="#92FFFF"/>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_6430_12787" x1="0.396782" y1="6.31092" x2="25.5569" y2="1.19453" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#3B3BF9"/>
                                        <stop offset="0.51" stop-color="#10E0F9"/>
                                        <stop offset="1" stop-color="#92FFFF"/>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_6430_12787" x1="3.97955" y1="21.1547" x2="22.1846" y2="4.2067" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white" stop-opacity="0.2"/>
                                        <stop offset="1" stop-color="white" stop-opacity="0.49"/>
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_6430_12787" x1="4.25026" y1="3.35963" x2="21.4872" y2="20.5173" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="white"/>
                                        <stop offset="1" stop-color="white" stop-opacity="0"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                @else 
                                    <svg width="25" height="23" viewBox="0 0 25 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M19.6445 10.6212C22.5774 10.6212 24.9551 8.24359 24.9551 5.31061C24.9551 2.37764 22.5774 0 19.6445 0C16.7115 0 14.3339 2.37764 14.3339 5.31061C14.3339 8.24359 16.7115 10.6212 19.6445 10.6212Z" fill="url(#paint0_linear_6430_10823)"/>
                                        <path d="M19.6445 10.6212C22.5774 10.6212 24.9551 8.24359 24.9551 5.31061C24.9551 2.37764 22.5774 0 19.6445 0C16.7115 0 14.3339 2.37764 14.3339 5.31061C14.3339 8.24359 16.7115 10.6212 19.6445 10.6212Z" fill="url(#paint1_linear_6430_10823)"/>
                                        <path d="M5.31061 10.6212C8.24359 10.6212 10.6212 8.24359 10.6212 5.31061C10.6212 2.37764 8.24359 0 5.31061 0C2.37764 0 0 2.37764 0 5.31061C0 8.24359 2.37764 10.6212 5.31061 10.6212Z" fill="url(#paint2_linear_6430_10823)"/>
                                        <path data-figma-bg-blur-radius="18" d="M12.4753 2.74146C17.2127 2.7415 21.0525 6.58118 21.0525 11.3186C21.0525 13.645 20.1257 15.753 18.6208 17.2991L18.1345 17.7991L18.4353 18.428L19.3992 20.4465C19.5445 20.7516 19.4156 21.1124 19.116 21.2561C18.8107 21.4015 18.4499 21.2721 18.3064 20.9719H18.3054L17.5955 19.4866L17.1599 18.5745L16.2527 19.0208C15.1123 19.5816 13.8321 19.8977 12.4753 19.8977C11.1185 19.8977 9.83839 19.5816 8.698 19.0208L7.79077 18.5745L7.35425 19.4866L6.64526 20.97C6.51759 21.2357 6.22409 21.3659 5.95093 21.2981L5.83569 21.2571C5.57078 21.129 5.44156 20.8355 5.50952 20.5627L5.55054 20.4475L6.51538 18.428L6.81616 17.7991L6.32983 17.2991C4.82496 15.753 3.89822 13.6451 3.89819 11.3186C3.89819 6.58116 7.7379 2.74146 12.4753 2.74146Z" fill="url(#paint3_linear_6430_10823)" stroke="url(#paint4_linear_6430_10823)" stroke-width="2"/>
                                        <path d="M13.2583 5.5089C13.2583 5.07062 12.903 4.71533 12.4647 4.71533C12.0264 4.71533 11.6711 5.07062 11.6711 5.5089V11.4752C11.6711 11.9135 12.0264 12.2688 12.4647 12.2688C12.903 12.2688 13.2583 11.9135 13.2583 11.4752V5.5089Z" fill="white"/>
                                        <path d="M16.1528 12.271C16.5911 12.271 16.9464 11.9157 16.9464 11.4774C16.9464 11.0391 16.5911 10.6838 16.1528 10.6838H12.4669C12.0287 10.6838 11.6734 11.0391 11.6734 11.4774C11.6734 11.9157 12.0287 12.271 12.4669 12.271H16.1528Z" fill="white"/>
                                        <defs>
                                        <clipPath id="bgblur_0_6430_10823_clip_path" transform="translate(15.1018 16.2585)"><path d="M12.4753 2.74146C17.2127 2.7415 21.0525 6.58118 21.0525 11.3186C21.0525 13.645 20.1257 15.753 18.6208 17.2991L18.1345 17.7991L18.4353 18.428L19.3992 20.4465C19.5445 20.7516 19.4156 21.1124 19.116 21.2561C18.8107 21.4015 18.4499 21.2721 18.3064 20.9719H18.3054L17.5955 19.4866L17.1599 18.5745L16.2527 19.0208C15.1123 19.5816 13.8321 19.8977 12.4753 19.8977C11.1185 19.8977 9.83839 19.5816 8.698 19.0208L7.79077 18.5745L7.35425 19.4866L6.64526 20.97C6.51759 21.2357 6.22409 21.3659 5.95093 21.2981L5.83569 21.2571C5.57078 21.129 5.44156 20.8355 5.50952 20.5627L5.55054 20.4475L6.51538 18.428L6.81616 17.7991L6.32983 17.2991C4.82496 15.753 3.89822 13.6451 3.89819 11.3186C3.89819 6.58116 7.7379 2.74146 12.4753 2.74146Z"/>
                                        </clipPath><linearGradient id="paint0_linear_6430_10823" x1="0.964397" y1="9.10928" x2="26.1246" y2="3.99288" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#820000"/>
                                        <stop offset="0.51" stop-color="white"/>
                                        <stop offset="1" stop-color="#C10F1A"/>
                                        </linearGradient>
                                        <linearGradient id="paint1_linear_6430_10823" x1="0.964397" y1="9.10928" x2="26.1246" y2="3.99288" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#820000"/>
                                        <stop offset="0.51" stop-color="white"/>
                                        <stop offset="1" stop-color="#C10F1A"/>
                                        </linearGradient>
                                        <linearGradient id="paint2_linear_6430_10823" x1="0.396782" y1="6.31092" x2="25.5569" y2="1.19453" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#C10F1A"/>
                                        <stop offset="0.51" stop-color="white"/>
                                        <stop offset="1" stop-color="#820000"/>
                                        </linearGradient>
                                        <linearGradient id="paint3_linear_6430_10823" x1="3.97955" y1="21.1547" x2="22.1846" y2="4.2067" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#C10F1A" stop-opacity="0.2"/>
                                        <stop offset="1" stop-color="#C10F1A" stop-opacity="0.49"/>
                                        </linearGradient>
                                        <linearGradient id="paint4_linear_6430_10823" x1="4.25026" y1="3.35963" x2="21.4872" y2="20.5173" gradientUnits="userSpaceOnUse">
                                        <stop stop-color="#C10F1A"/>
                                        <stop offset="1" stop-color="#E32121" stop-opacity="0"/>
                                        </linearGradient>
                                        </defs>
                                    </svg>
                                @endif
                                <span class="{{$k == 0 ? 'text-white' : ''}}">
                                    {{$item->published_at->format('d.m.Y - H:i:s')}}
                                </span>
                            </div>
                        </div>
                        <div class="{{$k === 0 ? 'card-glass' : 'card-white-glass'}} absolute bottom-0 right-0 w-fit p-2.5 border transform group-hover:translate-y-[-10px] transition duration-300 ease-linear">
                            <svg width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M1 21L21 1M21 1H3.22222M21 1V18.7778" stroke="{{$k == 0 ? 'white' : '#252525'}}"/>
                            </svg>
                        </div>
                    </a>
                @endforeach
            </div>
        @endif
    </div>
</section>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        if (window.location.hash === '#news-block') {
            const newsBlock = document.getElementById('news-block');
            if (newsBlock) {
                newsBlock.scrollIntoView({
                    block: 'start'
                });
            }
        }
    });
</script>
