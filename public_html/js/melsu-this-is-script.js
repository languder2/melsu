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
                    setTimeout( () =>{
                        lineHexLeft[index].classList.remove('start');
                        lineHexRight[index].classList.remove('start');
                    }, 100);
                    setTimeout( () =>{
                        lineHexLeft[index].classList.remove('befo');
                        lineHexRight[index].classList.remove('befo');
                    }, 400);
                    setTimeout( () =>{
                        lineHexLeft[index].classList.remove('aftr');
                        lineHexRight[index].classList.remove('aftr');
                    }, 700);
                    setTimeout( () =>{
                        block.classList.remove('load');
                        infoHexWrappRight[index].classList.remove('load');
                    }, 1000);
                }, 2000 + index * 1500);
            });
            imgHexLeft.forEach((img, index) => {
                setTimeout(() => {
                    img.classList.remove('start');
                    imgHexRight[index].classList.remove('start');
                }, 2300 + index * 2900);
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

