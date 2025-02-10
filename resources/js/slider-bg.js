document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.background-slider')) {
        const slides = document.querySelectorAll('.slide');
        const slider = document.querySelector('.background-slider');
        let currentSlide = 0;
        let isAnimating = false;
        const slideCount = slides.length;

        function showSlide(n) {
            if (isAnimating) return;
            isAnimating = true;

            const current = slider.children[currentSlide];
            let nextIndex = n % slideCount;
            if (nextIndex < 0) {
                nextIndex = slideCount + nextIndex;
            }
            const next = slider.children[nextIndex];

            // Устанавливаем начальное положение следующего слайда справа
            next.style.transform = 'translateX(130%)';
            next.style.opacity = '1';

            // Запускаем анимацию
            requestAnimationFrame(() => {
                current.style.transition = 'transform 1s ease-in-out, opacity 1s ease-in-out';
                next.style.transition = 'transform 1s ease-in-out, opacity 1s ease-in-out';

                current.style.transform = 'translateX(-100%)';
                current.style.opacity = '0';

                next.style.transform = 'translateX(0)';

                setTimeout(() => {
                    current.style.transition = '';
                    current.style.transform = 'translateX(130%)';
                    current.style.opacity = '0';

                    currentSlide = nextIndex;
                    isAnimating = false;
                }, 1000);
            });
        }


        slides[0].style.opacity = '1';

        setInterval(() => {
            showSlide(currentSlide + 1);
        }, 3000);
    }
})
