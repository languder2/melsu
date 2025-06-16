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
                    <a href="{{ route('clusters.list') }}" class="under-info flex gap-2 items-center">
                        <span>
                            <svg width="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.663 8.85C21.2522 6.81022 21.0868 5.03955 20.0236 3.97636C17.7744 1.7271 12.3587 3.49602 7.92736 7.92736C7.45397 8.40074 7.01097 8.88536 6.6 9.37615M17.4 14.6238C16.989 15.1146 16.546 15.5993 16.0726 16.0726C11.6413 20.504 6.22562 22.2729 3.97636 20.0236C2.83569 18.883 2.72842 16.928 3.47772 14.7" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12.6734 9.30078L10.9223 11.3711C10.7086 11.6483 10.6017 11.7869 10.6679 11.8938C10.7341 12.0008 10.9268 12.0008 11.3122 12.0008H12.6847C13.0701 12.0008 13.2627 12.0008 13.329 12.1077C13.3952 12.2147 13.2883 12.3533 13.0745 12.6304L11.3122 14.7008" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M9.75 17.7059C9.13145 17.2114 8.52058 16.6659 7.92736 16.0726C3.49602 11.6413 1.7271 6.22562 3.97636 3.97636C5.11702 2.83569 7.07202 2.72842 9.3 3.47772M14.25 20.3607C16.6631 21.2813 18.8068 21.2405 20.0236 20.0236C22.2729 17.7744 20.504 12.3587 16.0726 7.92736C15.4794 7.33413 14.8686 6.78862 14.25 6.29407" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>
                        <span class="text-under-info text-2xl font-semibold">
                        Флагманские проекты
                    </span>
                    </a>
                    <a href="{{url('programma-razvitiya-melsu')}}" class="under-info flex gap-2 items-center">
                        <span class="icon-box">
                            <svg aria-hidden="true"
                                 class="e-font-icon-svg e-far-calendar-alt"
                                 viewBox="0 0 448 512"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M148 288h-40c-6.6 0-12-5.4-12-12v-40c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v40c0 6.6-5.4 12-12 12zm108-12v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 96v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm-96 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm192 0v-40c0-6.6-5.4-12-12-12h-40c-6.6 0-12 5.4-12 12v40c0 6.6 5.4 12 12 12h40c6.6 0 12-5.4 12-12zm96-260v352c0 26.5-21.5 48-48 48H48c-26.5 0-48-21.5-48-48V112c0-26.5 21.5-48 48-48h48V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h128V12c0-6.6 5.4-12 12-12h40c6.6 0 12 5.4 12 12v52h48c26.5 0 48 21.5 48 48zm-48 346V160H48v298c0 3.3 2.7 6 6 6h340c3.3 0 6-2.7 6-6z">
                                </path>
                            </svg>
                        </span>
                        <span class="text-under-info text-2xl font-semibold">
                            Программа развития МелГУ на 2023-2028 годы
                        </span>
                    </a>
                </div>
                <div class="box-info-under-slider ">
                    <a href="{{ url('selekcionno-semenovodcheskij-centr-vysokotekhnologichnyj-selekcionno-pitomnikovodcheskij-kompleks-plodovyh-kultur-novorossii') }}" class="under-info flex gap-2 items-center">
                        <svg width="40" height="40" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M22 16.5C22 19.5376 19.5376 22 16.5 22C13.4624 22 11 19.5376 11 16.5C11 13.4624 13.4624 11 16.5 11C19.5376 11 22 13.4624 22 16.5Z" stroke="white" stroke-width="1.5"/>
                            <path d="M10.5 11C9.62217 10.37 8.55171 10 7.39646 10C4.41608 10 2 12.4624 2 15.5C2 18.5376 4.41608 21 7.39646 21C8.08877 21 8.75062 20.8671 9.35882 20.6251" stroke="white" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M16 13C14.1631 11.1035 11.7291 7.13692 13.7946 4M16 2C14.9847 2.59904 14.2703 3.27752 13.7946 4M13.7946 4C11.4006 4.5 6.09142 6.5 7.13408 12" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>

                        <span class="text-under-info text-2xl font-semibold text-wrap text-center">
                            Селекционно-семеноводческий центр
{{--                            <br>--}}
{{--                            «Высокотехнологичный селекционно-питомниководческий комплекс плодовых культур Новороссии»--}}
                        </span>
                    </a>
                </div>
            </div>

        </div>
        <div class="slider-button prev" title="Previous">
            <i class="bi bi-chevron-left"></i>
        </div>
        <div class="slider-button next" title="Next">
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
