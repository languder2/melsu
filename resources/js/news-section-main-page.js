let btns = document.querySelectorAll('.nav-btns a');
let moreBtns = document.querySelectorAll('.more-btns .btn-more-box');
let wrapperBox = document.querySelector('.wrapper-news');
let contentWrapper = document.querySelectorAll('.wrapper-news .elem');
btns.forEach((point, index) => {
    point.addEventListener('click', () => {
        btns.forEach(btn => {
            btn.classList.remove('active');
        });
        moreBtns.forEach(moreBtn => {
            moreBtn.classList.remove('active');
        });
        contentWrapper.forEach(content => {
            content.classList.remove('active');
        });
        if (index === 1 || index === 2) {
            wrapperBox.classList.add('elm');
        } else {
            wrapperBox.classList.remove('elm');
        }
        point.classList.add('active');
        moreBtns[index].classList.add('active');
        contentWrapper[index].classList.add('active');
    });
});
