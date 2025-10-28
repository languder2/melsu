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

        const handleMove = (e) => {
            if (!isDown) return;
            e.preventDefault();

            let currentX;

            if (e.type === 'touchmove') {
                currentX = e.touches[0].clientX;
            } else {
                currentX = e.pageX;
            }

            const walk = (currentX - startX) * 2; // Множитель 2 для ускорения

            trigger.scrollLeft = scrollLeft - walk;
        };

        trigger.addEventListener('mousedown', handleStart);
        trigger.addEventListener('mouseup', handleEnd);
        trigger.addEventListener('mouseleave', handleEnd);
        trigger.addEventListener('mousemove', handleMove);

        trigger.addEventListener('touchstart', handleStart, { passive: false });
        trigger.addEventListener('touchend', handleEnd);
        trigger.addEventListener('touchcancel', handleEnd); // Добавляем touchcancel
        trigger.addEventListener('touchmove', handleMove, { passive: false });

        trigger.style.cursor = 'grab';
    });

});
