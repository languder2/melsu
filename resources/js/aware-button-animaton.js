const positionAwareElements = document.querySelectorAll('.position-aware');

positionAwareElements.forEach(element => {
    element.addEventListener('mouseenter', (event) => {
        const elementRect = element.getBoundingClientRect();
        const relativeX = event.clientX - elementRect.left;
        const relativeY = event.clientY - elementRect.top;
        const span = element.querySelector('.aware-bg');

        let currentWidth = 2.5; // Начальная ширина
        const targetWidth = 100; // Целевая ширина
        let currentHeight = 2.5; // Начальная ширина
        const targetHeight = 100; // Целевая ширина
        const increment = 10; // Приращение ширины за один шаг
        const intervalTime = 10; // Время между шагами в миллисекундах

        function increaseWidth() {
            currentWidth += increment;
            span.style.width = currentWidth + 'vw';
            currentHeight += increment;
            span.style.height = currentHeight + 'vw';
            if (currentWidth >= targetWidth && currentHeight >= targetHeight) {
                clearInterval(interval);
            }
        }
        const interval = setInterval(increaseWidth, intervalTime);

        span.style.top = `${relativeY}px`;
        span.style.left = `${relativeX}px`;
    });

    element.addEventListener('mouseout', (event) => {
        const elementRect = element.getBoundingClientRect();
        const relativeX = event.clientX - elementRect.left;
        const relativeY = event.clientY - elementRect.top;
        const span = element.querySelector('.aware-bg');

       /* let currentWidth = 102.5; // Начальная ширина
        const targetWidth = 0; // Целевая ширина
        let currentHeight = 102.5; // Начальная ширина
        const targetHeight = 0; // Целевая ширина
        const decrement = 10;
        const intervalTime = 10;

        function increaseWidth() {
            currentWidth -= decrement;
            span.style.width = currentWidth + 'vw';
            currentHeight -= decrement;
            span.style.height = currentHeight + 'vw';
            if (currentWidth <= targetWidth && currentHeight <= targetHeight) {
                clearInterval(interval);
            }
        }
        const interval = setInterval(increaseWidth, intervalTime);*/
        span.style.width = '0'
        span.style.height = '0'
        span.style.top = `${relativeY }px`;
        span.style.left = `${relativeX}px`;
    });
});
