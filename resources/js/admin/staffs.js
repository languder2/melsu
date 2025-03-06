export function selectStaff(element) {
    element.closest('.staffBlock').querySelector('.staffID').value = element.dataset['staffId'];
    element.closest('.staffBlock').querySelector('.staffFullName').value = element.dataset['staffFullName'];
}

let timer = null;

export function KeyUp(element) {

    clearTimeout(timer);

    timer = setTimeout(() => {

        let list = element.closest('.staffBlock').querySelectorAll('.StaffList li');

        if (!list) return;

        let searchTerm = element.value.toLowerCase(); // Convert search term to lowercase once

        if (searchTerm === '')
            element.closest('.staffBlock').querySelector('.staffID').value = '';

        list.forEach(el =>
            el.classList.toggle(
                'hidden',
                searchTerm !== '' && !el.innerText.toLowerCase().toLowerCase().includes(searchTerm)
            )
        );

        if (element.closest('.staffBlock').querySelectorAll('.StaffList li:not(.hidden)').length === 0)
            element.closest('.staffBlock').querySelector('.staffID').value = '';

    }, 250)

}
