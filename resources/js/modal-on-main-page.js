document.addEventListener('DOMContentLoaded', function () {
    if (document.querySelector('.excursion-btn')) {
        let btnModal = document.querySelector('.excursion-btn');
        let modalBox = document.querySelector('.excursion-menu-box');
        let modal = document.querySelector('.excursion-menu');

        if (btnModal === null || modalBox === null || modal === null) return false;

        btnModal.addEventListener('click', function () {
            modal.classList.toggle('open')
            modalBox.classList.toggle('open')
        });

    }
});
