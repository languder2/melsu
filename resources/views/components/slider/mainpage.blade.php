<section class="slider-section">
    <div class="box-slider sldr">
        <div class="slider sldr">
            <div class="slide_viewer sldr">
                <div class="previous_btn" title="Previous">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <div class="slide_group sldr">
                    <div class="slide">
                        <a href="https://abiturient.mgu-mlt.ru/" class="slide-link cursor-pointer">
                            <img src="{{asset('img/Banner_priom_2025.png')}}" alt="" class="hidden sm:block">
                            <img src="{{asset('img/Banner_priom_mob.png')}}" alt="" class="block sm:hidden">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="{{ route('regiment:public:list') }} " class="slide-link cursor-pointer">
                            <img src="{{asset('storage/images/gallery/uzoxDl581PW0Qzh7NGUlzZcATgbUgUnYIrQOu65s/image.webp')}}" alt="">
                        </a>
                    </div>
                    <div class="slide bg-cover bg-center h-full"
                        style="background-image: url({{asset('storage/images/gallery/VqccB8QnkZo2QJSedA1VWkcr5dg5XTGteeIdbxOU/image.webp')}})"
                    >

                    </div>
                    <div class="slide">
                            <img src="{{asset('img/Slide.jpg')}}" alt="">
                        <div id="countdown" class="countdown hidden">
                            <div class="countdown-item">
                                <span id="days"></span>
                                <div class="countdown-label">дней</div>
                            </div>
                            <div class="countdown-item">
                                <span id="hours"></span>
                                <div class="countdown-label">часов</div>
                            </div>
                            <div class="countdown-item">
                                <span id="minutes"></span>
                                <div class="countdown-label">минут</div>
                            </div>
                            <div class="countdown-item">
                                <span id="seconds"></span>
                                <div class="countdown-label">секунд</div>
                            </div>
                        </div>
                    </div>
                    <div class="slide">
                        <a href="https://melsu.ru/uchebnye-korpusa" class="slide-link">
                            <img src="{{asset('img/Slide2.jpg')}}" alt="">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="#" class="slide-link">
                            <img src="{{asset('img/Slide3.jpg')}}" alt="">
                        </a>
                    </div>
                </div>
                <div class="next_btn" title="Next">
                    <i class="bi bi-chevron-right"></i>
                </div>
            </div>
        </div>

        <div class="slide_buttons sldr">
        </div>
    </div>
    <div class="info-under-slider">
        <div class="slider-container">
            <div class="slider-wrapper">
                <div class="box-info-under-slider ">
                    <a href="{{ route('clusters.list') }}" class="under-info flex gap-2 items-center justify-between bg-[#C10F1A]">
                        <span class="text-under-info font-semibold">
                            Флагманские проекты
                        </span>
                        <div class="ico-link bg-white rounded-full w-[40px] h-[40px] sm:w-[60px] sm:h-[60px] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.66667 1H17M17 1V14.3333M17 1L1 17" stroke="#252525" stroke-width="2"/>
                            </svg>
                        </div>
                    </a>
                    <a href="{{url('programma-razvitiya-melsu')}}" class="under-info flex gap-2 items-center justify-between bg-[#252525]">
                        <span class="text-under-info font-semibold">
                            Программа развития МелГУ на 2023-2028 годы
                        </span>
                        <div class="ico-link bg-white rounded-full w-[40px] h-[40px] sm:w-[60px] sm:h-[60px] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.66667 1H17M17 1V14.3333M17 1L1 17" stroke="#252525" stroke-width="2"/>
                            </svg>
                        </div>
                    </a>
                </div>
                <div class="box-info-under-slider ">
                    <a href="{{ url('selekcionno-semenovodcheskij-centr-vysokotekhnologichnyj-selekcionno-pitomnikovodcheskij-kompleks-plodovyh-kultur-novorossii') }}" class="under-info flex gap-2 items-center justify-between">
                        <span class="text-under-info font-semibold text-wrap text-center">
                            Селекционно-семеноводческий центр
                            {{--<br>--}}
                            {{--«Высокотехнологичный селекционно-питомниководческий комплекс плодовых культур Новороссии»--}}
                        </span>
                        <div class="ico-link bg-white rounded-full w-[40px] h-[40px] sm:w-[60px] sm:h-[60px] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.66667 1H17M17 1V14.3333M17 1L1 17" stroke="#252525" stroke-width="2"/>
                            </svg>
                        </div>
                    </a>
                </div>
            </div>

        </div>
        <div class="slider-button prev hidden" title="Previous">
            <i class="bi bi-chevron-left"></i>
        </div>
        <div class="slider-button next hidden" title="Next">
            <i class="bi bi-chevron-right"></i>
        </div>
    </div>
</section>
<script>
    const sliderWrapper = document.querySelector('.slider-wrapper');
    const slides = document.querySelectorAll('.box-info-under-slider');
    const prevButton = document.querySelector('.prev');
    const nextButton = document.querySelector('.next');

    let currentIndex = 1;
    let slideInterval;

    const firstSlide = slides[0].cloneNode(true);
    const lastSlide = slides[slides.length - 1].cloneNode(true);

    sliderWrapper.appendChild(firstSlide);
    sliderWrapper.insertBefore(lastSlide, slides[0]);

    const updatedSlides = document.querySelectorAll('.box-info-under-slider');

    function updateSlider() {
        const offset = -currentIndex * 100;
        sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
        sliderWrapper.style.transform = `translateX(${offset}%)`;
    }

    function startAutoSlide() {
        clearInterval(slideInterval);
        slideInterval = setInterval(() => {
            currentIndex++;
            if (currentIndex === updatedSlides.length - 1) {
                updateSlider();
            }
            if (currentIndex >= updatedSlides.length - 1) {
                setTimeout(() => {
                    sliderWrapper.style.transition = 'none';
                    currentIndex = 1;
                    sliderWrapper.style.transform = `translateX(${-currentIndex * 100}%)`;

                    setTimeout(() => {
                        sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
                    }, 20);
                }, 500);
            } else {
                updateSlider();
            }
        }, 3000);
    }

    function resetAutoSlide() {
        clearInterval(slideInterval);
        startAutoSlide();
    }

    prevButton.addEventListener('click', () => {
        currentIndex--;
        if (currentIndex <= 0) {
            updateSlider();
            setTimeout(() => {
                sliderWrapper.style.transition = 'none';
                currentIndex = updatedSlides.length - 2;
                sliderWrapper.style.transform = `translateX(${-currentIndex * 100}%)`;

                setTimeout(() => {
                    sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
                }, 20);
            }, 500);
        } else {
            updateSlider();
        }

        resetAutoSlide();
    });

    nextButton.addEventListener('click', () => {
        currentIndex++;
        if (currentIndex >= updatedSlides.length - 1) {
            updateSlider();
            setTimeout(() => {
                sliderWrapper.style.transition = 'none';
                currentIndex = 1;
                sliderWrapper.style.transform = `translateX(${-currentIndex * 100}%)`;

                setTimeout(() => {
                    sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
                }, 20);
            }, 500);
        } else {
            updateSlider();
        }

        resetAutoSlide();
    });

    window.addEventListener('load', () => {
        sliderWrapper.style.transform = `translateX(${-currentIndex * 100}%)`;
        sliderWrapper.style.transition = 'transform 0.5s ease-in-out';
        startAutoSlide();
    });
</script>
