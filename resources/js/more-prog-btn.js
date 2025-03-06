document.addEventListener('DOMContentLoaded', () => {
    if (document.querySelector('.more-prog-btn')) {
        var moreProgBtn = document.querySelector('.more-prog-btn');

        var progInfo = document.querySelector('.prog-info');

        if (moreProgBtn === null) return false;

        moreProgBtn.addEventListener('click', function () {
            progInfo.classList.toggle('line-clamp-4');
            if (!progInfo.classList.contains('line-clamp-4')) {
                moreProgBtn.innerHTML = 'Свернуть';
            } else {
                moreProgBtn.innerHTML = 'Подробнее о программе';
            }
        });
    }
})
