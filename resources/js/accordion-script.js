document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelectorAll('.accordion-toggle')) {
        const accordionItems = document.querySelectorAll('.accordion-toggle');
        const accordionContentBox = document.querySelectorAll('.accordion-content-box');
        const accordionText = document.querySelectorAll('.accordion-text');
        const accordionBox = document.querySelectorAll('.accordion-box');
        const accordionArrow = document.querySelectorAll('.accordion-box svg');
        var height = [];
        var defaultHeight = [];
        var rect = [];
        var newWidth = [];

        console.log(accordionItems);

        accordionItems.forEach((item, index) => {
            rect[index] = accordionText[index].getBoundingClientRect();
            newWidth[index] = accordionItems[index].offsetWidth;
            accordionContentBox[index].style.width = newWidth[index] + 'px';
            defaultHeight[index] = accordionBox[index].getBoundingClientRect().height;

            height[index] = rect[index].height;
            height[index] += parseInt(defaultHeight[index]);
            accordionBox[index].style.height = defaultHeight[index] + 'px';
            window.addEventListener('resize', () => {
                newWidth[index] = accordionItems[0].offsetWidth;
                accordionContentBox[index].style.width = newWidth[index] + 'px';
                rect[index] = accordionText[index].getBoundingClientRect();
                height[index] = 0;
                height[index] = rect[index].height + parseInt(defaultHeight[index]);
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
                    accordionBox[index].style.height = defaultHeight[index] + 'px';
                    accordionArrow[index].style.transform = 'rotateZ(0deg)';
                }
            });
        });
    }
});

