
function checkScreenWidth() {
    const video = document.getElementById('intro-video');
    const screenWidth = window.innerWidth;

    if (screenWidth >= 1367) {
        video.addEventListener('play', function () {
            document.body.style.overflow = 'hidden';
        });
        video.addEventListener('ended', () => {
            video.classList.add('end');
            document.body.style.overflow = 'auto';
        }, {once: true})
    }
    else  {
        video.src = '../assets/video/load-mob.webm';
        video.addEventListener('play', function () {
            document.body.style.overflow = 'hidden';
        });
        video.addEventListener('ended', () => {
            video.classList.add('end');
            document.body.style.overflow = 'auto';
        }, {once: true})

    }
}

window.onload = checkScreenWidth;


window.addEventListener('resize', checkScreenWidth);