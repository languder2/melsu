document.addEventListener('DOMContentLoaded', () => {

    function checkScreenWidth() {
        const video = document.getElementById('intro-video');
        const videoWrapper = document.querySelector('.wrapper-video');
        const screenWidth = window.innerWidth;
        if (!video || !videoWrapper) return;

        if (screenWidth >= 1367) {
            video.addEventListener('play', function () {
                document.body.classList.add('no-scroll');
            });
            video.addEventListener('ended', () => {
                videoWrapper.classList.add('end');
                document.body.classList.remove('no-scroll');
            }, {once: true})
        } else if (screenWidth >= 991) {
            video.src = '../assets/video/load-mob.webm';
            video.addEventListener('play', function () {
                document.body.classList.add('no-scroll');
            });
            video.addEventListener('ended', () => {
                videoWrapper.classList.add('end');
                document.body.classList.remove('no-scroll');
            }, {once: true})

        } else {
            videoWrapper.style.display = "none";
        }
    }

    window.onload = checkScreenWidth;

    document.addEventListener("DOMContentLoaded", () => {
        window.addEventListener('resize', checkScreenWidth);
    });
})
