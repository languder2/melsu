const positionAwareElements = document.querySelectorAll('.position-aware')
if (positionAwareElements) {

    positionAwareElements.forEach(element => {
        let isAnimating = false;
        let animationFrame;

        element.addEventListener('mouseenter', (event) => {
            const elementRect = element.getBoundingClientRect();
            const relativeX = event.clientX - elementRect.left;
            const relativeY = event.clientY - elementRect.top;
            const span = element.querySelector('.aware-bg');

            let currentWidth = 2.5;
            const targetWidth = 100;
            let currentHeight = 2.5;
            const targetHeight = 100;
            const increment = 10;

            isAnimating = true;

            function animate() {
                if (!isAnimating) return;

                if (currentWidth < targetWidth || currentHeight < targetHeight) {
                    currentWidth += increment;
                    currentHeight += increment;
                    span.style.width = currentWidth + 'vw';
                    span.style.height = currentHeight + 'vw';
                    animationFrame = requestAnimationFrame(animate);
                }
            }

            span.style.top = `${relativeY}px`;
            span.style.left = `${relativeX}px`;
            animate();
        });

        element.addEventListener('mouseleave', () => {
            isAnimating = false;
            cancelAnimationFrame(animationFrame);

            const span = element.querySelector('.aware-bg');
            span.style.width = '0';
            span.style.height = '0';
        });
    });
}
