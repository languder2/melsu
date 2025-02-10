document.addEventListener("DOMContentLoaded", () => {
    let departmentsSearch = document.querySelector('.departments-search');
    if (!departmentsSearch) return;

    let list = document.querySelectorAll('.departments-box');
    if (!list.length) return;

    let timer = null;

    departmentsSearch.addEventListener('keyup', () => {
        clearTimeout(timer);
        timer = setTimeout(
            () => departmentsSearch.dispatchEvent(new Event('change')),
            300
        );
    })

    departmentsSearch.addEventListener('change', () => {
        list.forEach(el =>
            el.classList.toggle(
                'hidden',
                !el.textContent.toLowerCase().includes(departmentsSearch.value.toLowerCase())
            )
        )
    });


});
