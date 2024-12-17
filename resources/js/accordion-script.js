document.addEventListener('DOMContentLoaded', function() {
    if( document.querySelectorAll('.accordion-toggle')) {
        const accordionItems = document.querySelectorAll('.accordion-toggle');
        const accordionContentBox = document.querySelectorAll('.accordion-content-box');
        const accordionText = document.querySelectorAll('.accordion-text');
        const accordionBox = document.querySelectorAll('.accordion-box');
        const accordionArrow = document.querySelectorAll('.accordion-box svg');
        var height = [];

        accordionItems.forEach((item, index) => {
            var rect = accordionText[index].getBoundingClientRect();
            height[index] = rect.height;
            height[index] += 75;
            var newWidth = accordionItems[index].offsetWidth;
            accordionContentBox[index].style.width = newWidth + 'px';

            window.addEventListener('resize', () => {
                newWidth = accordionItems[0].offsetWidth;
                accordionContentBox[index].style.width = newWidth + 'px';
                rect = accordionText[index].getBoundingClientRect();
                height[index] = 0;
                height[index] = rect.height + 75;
            });
            item.addEventListener('click', function () {
                const content = accordionContentBox[index];
                const isExpanded = content.classList.contains('show');

                content.classList.toggle('show', !isExpanded);
                if (content.classList.contains('show')) {
                    accordionBox[index].classList.add('show');
                    accordionBox[index].style.height = height[index] + 'px';
                    accordionArrow[index].style.transform = 'rotateZ(180deg)';
                } else {
                    accordionBox[index].classList.remove('show');
                    accordionBox[index].style.height = '73px';
                    accordionArrow[index].style.transform = 'rotateZ(0deg)';
                }
            });
        });
    }
});

