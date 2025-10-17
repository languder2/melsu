document.addEventListener('DOMContentLoaded',(evt)=>{
    const sliders = document.querySelectorAll('.editor-slider');
    const showImage = (event) => {
        event.target.closest('.editor-slider')
            .querySelectorAll('.slides .slide')
            .forEach(el=> el.toggleAttribute('open', el.dataset.slide === event.target.dataset.slide));

        event.target.closest('.editor-slider')
            .querySelectorAll('.triggers .trigger')
            .forEach(el=> el.toggleAttribute('open', el.dataset.slide === event.target.dataset.slide));
    }

    sliders.forEach((slider)=>{
        slider.querySelectorAll('.triggers .trigger').forEach((trigger)=>{
            trigger.addEventListener('mousedown', showImage)
        });
    });


    const scrollAreas = document.querySelectorAll('.triggers');

    scrollAreas.forEach(trigger => {
        let isDown = false;
        let startX = 0;
        let scrollLeft = 0;
        let touchHandled = false;

        const handleStart = (e) => {
            if (e.type === 'touchstart') {
                touchHandled = true;
                startX = e.touches[0].clientX;
            }
            else {
                if (touchHandled) {
                    touchHandled = false;
                    return;
                }

                startX = e.pageX;
            }

            isDown = true;
            scrollLeft = trigger.scrollLeft;

            if (e.type === 'mousedown') {
                trigger.style.cursor = 'grabbing';
            }
        };

        const handleEnd = () => {
            isDown = false;
            trigger.style.cursor = 'grab';
        };

        // Объединенная функция движения (mousemove/touchmove)
        const handleMove = (e) => {
            if (!isDown) return;
            e.preventDefault(); // Предотвращаем выделение текста или стандартную прокрутку

            let currentX;

            if (e.type === 'touchmove') {
                // Используем клиентскую координату для тач-событий
                currentX = e.touches[0].clientX;
            } else {
                // Используем координату страницы для мыши
                currentX = e.pageX;
            }

            // Вычисляем смещение
            // (startX - currentX) - это расстояние, на которое мы "тянем"
            const walk = (currentX - startX) * 2; // Множитель 2 для ускорения

            // Применяем прокрутку
            // trigger.scrollLeft = НачальнаяПрокрутка - Смещение
            trigger.scrollLeft = scrollLeft - walk;
        };

        // ----------------------------------------------------
        // 2. НАЗНАЧЕНИЕ СЛУШАТЕЛЕЙ (Один раз на элемент)
        // ----------------------------------------------------

        // Мышь
        trigger.addEventListener('mousedown', handleStart);
        trigger.addEventListener('mouseup', handleEnd);
        trigger.addEventListener('mouseleave', handleEnd);
        trigger.addEventListener('mousemove', handleMove);

        // Сенсорный ввод (Используем { passive: false } т.к. мы вызываем e.preventDefault())
        trigger.addEventListener('touchstart', handleStart, { passive: false });
        trigger.addEventListener('touchend', handleEnd);
        trigger.addEventListener('touchcancel', handleEnd); // Добавляем touchcancel
        trigger.addEventListener('touchmove', handleMove, { passive: false });

        // Устанавливаем начальный курсор
        trigger.style.cursor = 'grab';
    });

});
