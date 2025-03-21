document.addEventListener('DOMContentLoaded', function () {
    const videoBlock = document.querySelector('.container-with-logo');
    const video = videoBlock.querySelector('video');

    videoBlock.addEventListener('mouseenter', function () {
        video.play();
    });

    video.addEventListener('ended', function () {
        video.pause();
        video.currentTime = 0;
    });

    videoBlock.addEventListener('mouseleave', function () {
        video.pause();
        video.currentTime = 0;
    });
});
