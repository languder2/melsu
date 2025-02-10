if (document.querySelector('.box-info-prog')) {
    var boxInfoProg = document.querySelectorAll('.box-info-prog .btn-info-prog');
    var ContentInfoProg = document.querySelectorAll('.content-info-prog');

    boxInfoProg.forEach((item, index) => {
        item.addEventListener('click', function () {
            boxInfoProg.forEach((e, index) => {
                if (e !== item) {
                    console.log(e)
                    e.classList.remove('active');
                    ContentInfoProg[index].classList.remove('active');
                    ContentInfoProg[index].classList.add('hidden');
                }
            });
            item.classList.add('active');
            ContentInfoProg[index].classList.remove('hidden');
            ContentInfoProg[index].classList.add('active');
        });
    });
}
