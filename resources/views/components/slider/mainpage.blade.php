<section class="slider-section">
    <div class="box-slider sldr">
        <div class="slider sldr">
            <div class="slide_viewer sldr">
                <div class="previous_btn" title="Previous">
                    <i class="bi bi-chevron-left"></i>
                </div>
                <div class="slide_group sldr">
                    <div class="slide">
                        <a href="https://melsu.ru/" class="slide-link cursor-pointer">
                            <img src="{{asset('img/slider/Platnoe.png')}}" alt="" class="hidden sm:block w-max">
                            <img src="{{asset('img/slider/Platnoe_mob_4x.png')}}" alt="" class="block sm:hidden">
                        </a>
                    </div>
                    <div class="slide">
                        <a href="https://melsu.ru/tselevoe-obuchenie" class="slide-link cursor-pointer">
                            <img src="{{asset('img/slider/Celevoe_banner.png')}}" alt="" class="hidden sm:block w-max">
                            <img src="{{asset('img/slider/Celevoe_banner_mob.png')}}" alt="" class="block sm:hidden">
                        </a>
                    </div>
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
                    <a href="https://abiturient.mgu-mlt.ru/documents" class="under-info flex gap-2 items-center justify-between bg-[#252525]">
                        <span class="text-under-info font-semibold">
                            Приказы о зачислении
                        </span>
                        <div class="ico-link bg-white rounded-full w-[40px] h-[40px] sm:w-[60px] sm:h-[60px] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.66667 1H17M17 1V14.3333M17 1L1 17" stroke="#252525" stroke-width="2"/>
                            </svg>
                        </div>
                    </a>
                    <a href="https://abiturient.mgu-mlt.ru/competition-lists" class="under-info flex gap-2 items-center justify-between bg-[#C10F1A]">
                        <span class="text-under-info font-semibold">
                            Конкурсные списки поступающих
                        </span>
                        <div class="ico-link bg-white rounded-full w-[40px] h-[40px] sm:w-[60px] sm:h-[60px] flex items-center justify-center">
                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M3.66667 1H17M17 1V14.3333M17 1L1 17" stroke="#252525" stroke-width="2"/>
                            </svg>
                        </div>
                    </a>

                </div>
                <div class="box-info-under-slider ">
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
    document.addEventListener('DOMContentLoaded', function() {
        const sliderWrapper = document.querySelector('.slider-wrapper');
        const slides = document.querySelectorAll('.box-info-under-slider');
        const prevBtn = document.querySelector('.prev');
        const nextBtn = document.querySelector('.next');

        // Настройки
        const settings = {
            slideDuration: 500,
            autoSlideInterval: 20000,
            swipeThreshold: 0.2,
            maxDragSlides: 2
        };

        // Состояние слайдера
        const state = {
            currentIndex: 1,
            isDragging: false,
            isAnimating: false,
            startX: 0,
            currentX: 0,
            dragOffset: 0,
            slideInterval: null,
            allSlides: null
        };

        function initSlider() {
            // Клон слайдов для бесконойной прокрутки
            const firstClone = slides[0].cloneNode(true);
            const lastClone = slides[slides.length - 1].cloneNode(true);

            firstClone.classList.add('clone');
            lastClone.classList.add('clone');

            sliderWrapper.appendChild(firstClone);
            sliderWrapper.insertBefore(lastClone, slides[0]);

            state.allSlides = document.querySelectorAll('.box-info-under-slider');

            // Установка начальной позиции
            setSlidePosition(state.currentIndex, false);

            // Добавление обработчиков событий
            addEventListeners();

            // Запуск автопрокрутки
            startAutoSlide();
        }

        // Установка позиции слайда
        function setSlidePosition(index, animate = true) {
            sliderWrapper.style.transition = animate ?
                `transform ${settings.slideDuration}ms ease-in-out` : 'none';
            sliderWrapper.style.transform = `translateX(${-index * 100}%)`;
        }

        // Переход к слайду
        function goToSlide(index, animate = true) {
            if (state.isAnimating) return;

            state.isAnimating = true;
            setSlidePosition(index, animate);

            setTimeout(function() {
                // Проверка на клоны и телепортация
                if (index === 0) {
                    state.currentIndex = state.allSlides.length - 2;
                    setSlidePosition(state.currentIndex, false);
                } else if (index === state.allSlides.length - 1) {
                    state.currentIndex = 1;
                    setSlidePosition(state.currentIndex, false);
                } else {
                    state.currentIndex = index;
                }

                setTimeout(function() {
                    state.isAnimating = false;
                }, 20);
            }, animate ? settings.slideDuration : 0);
        }

        // Обработка свайпа
        function handleSwipe() {
            const swipeRatio = Math.abs(state.dragOffset) / sliderWrapper.offsetWidth;
            const slidesToMove = Math.min(
                Math.floor(swipeRatio / settings.swipeThreshold),
                settings.maxDragSlides
            );

            const direction = state.dragOffset > 0 ? -1 : 1;
            goToSlide(state.currentIndex + (direction * slidesToMove));
        }

        // Автопрокрутка
        function startAutoSlide() {
            stopAutoSlide();
            state.slideInterval = setInterval(function() {
                if (!state.isDragging && !state.isAnimating) {
                    goToSlide(state.currentIndex + 1);
                }
            }, settings.autoSlideInterval);
        }

        function stopAutoSlide() {
            clearInterval(state.slideInterval);
        }

        function resetAutoSlide() {
            stopAutoSlide();
            setTimeout(startAutoSlide, settings.slideDuration + 100);
        }

        // Обработчики перетаскивания
        function handleDragStart(e) {
            if (state.isAnimating) return;

            state.isDragging = true;
            state.startX = e.clientX || e.touches[0].clientX;
            state.currentX = state.startX;
            sliderWrapper.style.transition = 'none';
            sliderWrapper.style.cursor = 'grabbing';
            stopAutoSlide();
        }

        function handleDragMove(e) {
            if (!state.isDragging) return;

            state.currentX = e.clientX || e.touches[0].clientX;
            state.dragOffset = state.currentX - state.startX;

            const limitedOffset = state.dragOffset * 0.7; // скорость перетаскивания
            const position = (-state.currentIndex * 100) + (limitedOffset / sliderWrapper.offsetWidth * 100);
            sliderWrapper.style.transform = `translateX(${position}%)`;
        }

        function handleDragEnd() {
            if (!state.isDragging) return;

            state.isDragging = false;
            sliderWrapper.style.cursor = 'grab';

            if (Math.abs(state.dragOffset) > sliderWrapper.offsetWidth * settings.swipeThreshold) {
                handleSwipe();
            } else {
                goToSlide(state.currentIndex);
            }

            resetAutoSlide();
            state.dragOffset = 0;
        }

        // обработчик событий
        function addEventListeners() {
            // Мышь
            sliderWrapper.addEventListener('mousedown', handleDragStart);
            document.addEventListener('mousemove', handleDragMove);
            document.addEventListener('mouseup', handleDragEnd);

            // Тач
            sliderWrapper.addEventListener('touchstart', handleDragStart, { passive: true });
            document.addEventListener('touchmove', handleDragMove, { passive: true });
            document.addEventListener('touchend', handleDragEnd);

            // Кнопки
            prevBtn.addEventListener('click', function() {
                goToSlide(state.currentIndex - 1);
                resetAutoSlide();
            });

            nextBtn.addEventListener('click', function() {
                goToSlide(state.currentIndex + 1);
                resetAutoSlide();
            });

            // Пауза при наведении
            sliderWrapper.addEventListener('mouseenter', stopAutoSlide);
            sliderWrapper.addEventListener('mouseleave', startAutoSlide);
        }

        initSlider();
    });
</script>
