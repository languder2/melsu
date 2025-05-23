
<section class="h--timeline js-h--timeline relative">
    <div id="prevtBtn" class="absolute left-10 top-[35%] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" class="bi bi-chevron-compact-left fill-white transition duration-300 ease-linear" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M9.224 1.553a.5.5 0 0 1 .223.67L6.56 8l2.888 5.776a.5.5 0 1 1-.894.448l-3-6a.5.5 0 0 1 0-.448l3-6a.5.5 0 0 1 .67-.223"/>
        </svg>
    </div>
    <div id="nextBtn" class="absolute right-10 top-[35%] z-10 bg-[#C10F1A]/[.6] rounded-full cursor-pointer p-2 transition duration-300 ease-linear hover:bg-[#C10F1A]">
        <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" fill="currentColor" class="bi bi-chevron-compact-right fill-white" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M6.776 1.553a.5.5 0 0 1 .671.223l3 6a.5.5 0 0 1 0 .448l-3 6a.5.5 0 1 1-.894-.448L9.44 8 6.553 2.224a.5.5 0 0 1 .223-.671"/>
        </svg>
    </div>
    <div class="h--timeline-events">
        <ol>
            <li class="h--timeline-event h--timeline-event--selected text-component bg-white history-slide overflow-hidden">
                <div class="h--timeline-event-content">
                    <div class="height-date z-5">
                        <div class="relative">
                            <span class="date-overlay">1874</span>
                            <span style="--under-date-bg-image: url('{{ asset('img/history/first-1-2.png') }}');" class="under-date">1874</span>
                        </div>
                    </div>
                    <div class="h--timeline-event-description z-5">
                        <p class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                            ТГАТУ начинает свою историю с 1874 года,
                            когда было создано Реальное училище города Мелитополя.
                            После революции на базе бывшего Реального училища был создан техникум,
                            который начал готовить специалистов по работе с сельскохозяйственной техникой.
                        </p>
                        <div class="btn-more-box flex items-center">
                            <a href="#" class="btn-more flex items-center" style="font-size: 16px;">Подробнее
                                <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full full-img-history">
                    <img src="{{asset('img/history/first-1.jpg')}}" class="object-cover h-full w-full" alt="">
                </div>
            </li>

            <li class="h--timeline-event text-component bg-white history-slide overflow-hidden">
                <div class="h--timeline-event-content">
                    <div class="height-date z-5">
                        <div class="relative">
                            <span class="date-overlay">1932</span>
                            <span style="--under-date-bg-image: url('{{ asset('img/history/second-1-2.jpg') }}');" class="under-date">1932</span>
                        </div>
                    </div>
                    <div class="h--timeline-event-description z-5">
                        <p class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                            В 1932 году на базе техникума индустриализации сельского хозяйства был создан технический вуз-завод
                            ВТУЗ им. ОГПУ. В 1934—1935 годах во ВТУЗе работало 13 кафедр и обучалось около 500 студентов.
                        </p>
                        <div class="btn-more-box flex items-center">
                            <a href="#" class="btn-more flex items-center" style="font-size: 16px;">Подробнее
                                <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full full-img-history">
                    <img src="{{asset('img/history/second-1.jpg')}}" class="object-cover h-full w-full" alt="">
                </div>
            </li>

            <li class="h--timeline-event text-component bg-white history-slide overflow-hidden">
                <div class="h--timeline-event-content">
                    <div class="height-date z-5">
                        <div class="relative">
                            <span class="date-overlay">1937</span>
                            <span style="--under-date-bg-image: url('{{ asset('img/history/third-1-2.jpg') }}');" class="under-date">1937</span>
                        </div>
                    </div>
                    <div class="h--timeline-event-description z-5">
                        <p class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                            В 1937 году ВТУЗ выпустил 96 первых инженеров-механиков.
                        </p>
                        <div class="btn-more-box flex items-center">
                            <a href="#" class="btn-more flex items-center" style="font-size: 16px;">Подробнее
                                <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full full-img-history">
                    <img src="{{asset('img/history/third-1.jpg')}}" class="object-cover h-full w-full" alt="">
                </div>
            </li>

            <li class="h--timeline-event text-component bg-white history-slide overflow-hidden">
                <div class="h--timeline-event-content">
                    <div class="height-date z-5">
                        <div class="relative">
                            <span class="date-overlay">1938</span>
                            <span style="--under-date-bg-image: url('{{ asset('img/history/fourth-1-2.jpg') }}');" class="under-date">1938</span>
                        </div>
                    </div>
                    <div class="h--timeline-event-description z-5">
                        <p class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                            В 1938 году начал работу Мелитопольский институт инженеров-механиков сельского хозяйства (МИИМСХ).
                        </p>
                        <div class="btn-more-box flex items-center">
                            <a href="#" class="btn-more flex items-center" style="font-size: 16px;">Подробнее
                                <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full full-img-history">
                    <img src="{{asset('img/history/fourth-1.jpg')}}" class="object-cover h-full w-full" alt="">
                </div>
            </li>

            <li class="h--timeline-event text-component bg-white history-slide overflow-hidden">
                <div class="h--timeline-event-content">
                    <div class="height-date z-5">
                        <div class="relative">
                            <span class="date-overlay">1981</span>
                            <span style="--under-date-bg-image: url('{{ asset('img/history/fifth-1-2.jpg') }}');" class="under-date">1981</span>
                        </div>
                    </div>
                    <div class="h--timeline-event-description z-5">
                        <p class="font-semibold text-md md:text-lg xl:text-xl line-clamp-6 lg:line-clamp-none">
                            25 марта 1981 года за успехи в подготовке высококвалифицированных специалистов МИМСХ был награждён орденом Трудового Красного Знамени.
                            После распада СССР МИМСХ был переименован в Таврический Государственный агротехнологический университет.
                        </p>
                        <div class="btn-more-box flex items-center">
                            <a href="#" class="btn-more flex items-center" style="font-size: 16px;">Подробнее
                                <i class="bi bi-arrow-right-circle-fill"></i></a>
                        </div>
                    </div>
                </div>
                <div class="w-full full-img-history">
                    <img src="{{asset('img/history/fifth-1.jpg')}}" class="object-cover h-full w-full" alt="">
                </div>
            </li>

        </ol>
    </div> <!-- .h--timeline-events -->
    <div class="h--timeline-container">
        <div class="h--timeline-dates">
            <div class="h--timeline-line">
                <ol>
                    <li><a data-date="16/01/1874" class="h--timeline-date cursor-pointer h--timeline-date--selected">1874</a></li>
                    <li><a data-date="28/02/1932" class="h--timeline-date cursor-pointer">1932</a></li>
                    <li><a data-date="20/04/1937" class="h--timeline-date cursor-pointer">1937</a></li>
                    <li><a data-date="20/05/1938" class="h--timeline-date cursor-pointer">1938</a></li>
                    <li><a data-date="09/07/1981" class="h--timeline-date cursor-pointer">1981</a></li>
                </ol>

                <span class="h--timeline-filling-line" aria-hidden="true"></span>
            </div>
        </div>

        <nav class="h--timeline-navigation-container">
            <ul>
                <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--prev h--timeline-navigation--inactive flex items-center">
                        <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M31 10.2571H0.999999M0.999999 10.2571L13.7869 1M0.999999 10.2571L13.7869 19" stroke="" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
                <li><a href="#0" class="text-replace h--timeline-navigation h--timeline-navigation--next flex items-center">
                        <svg width="31" height="20" viewBox="0 0 31 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M0 10.2571H30M30 10.2571L17.2131 1M30 10.2571L17.2131 19" stroke="" stroke-width="2" stroke-linejoin="round"/>
                        </svg>
                    </a>
                </li>
            </ul>
        </nav>
    </div>

</section>


<script src="{{asset('js/history-slider.js')}}"></script>
<script>
    document.querySelector('.my-6').classList.add('hidden');
</script>
