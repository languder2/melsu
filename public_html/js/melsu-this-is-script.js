document.addEventListener('DOMContentLoaded',()=>{
    const hex = document.querySelector('.hex');
    if(hex) {
        const symbol = document.querySelector('.changed-symbol');
        const infoHexWrappLeft = document.querySelectorAll('.left-info-box .info-hex-wrapp');
        const infoHexWrappRight = document.querySelectorAll('.right-info-box .info-hex-wrapp');
        const lineHexLeft = document.querySelectorAll('.line-hex-left');
        const lineHexRight = document.querySelectorAll('.line-hex-right');

        const imgHexLeft = document.querySelectorAll('.img-hex-left');
        const imgHexRight = document.querySelectorAll('.img-hex-right');
        if (window.matchMedia("(min-width: 1024px)").matches) {
            setTimeout(() => {
                symbol.classList.add('rotate');
            }, 1000);
            setTimeout(() => {
                symbol.innerHTML = '!';
            }, 1400);
            infoHexWrappLeft.forEach((block, index) => {
                setTimeout(() => {
                    block.classList.add('show');
                    infoHexWrappRight[index].classList.add('show');
                    lineHexLeft[index].classList.add('show');
                    lineHexRight[index].classList.add('show');
                }, 2000 + index * 300);
            });
            imgHexLeft.forEach((img, index) => {
                setTimeout(() => {
                    img.classList.add('show');
                    imgHexRight[index].classList.add('show');
                }, 2300 + index * 250);
            });
        } else {
            setTimeout(() => {
                symbol.classList.add('rotate');
            }, 1000);
            setTimeout(() => {
                symbol.innerHTML = '!';
            }, 1400);
        }
    }
});

