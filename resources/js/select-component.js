export function initSelect(selectWrapper) {
    let inputField = selectWrapper.querySelector('.chosen-value');
    let inputHiddenField = selectWrapper.querySelector('.input-hidden');
    let dropdown = selectWrapper.querySelector('.value-list');
    let dropdownItems = [...dropdown.querySelectorAll('.drop-li')];

    let filterItems = (inputValue) => {
        dropdownItems.forEach(item => {
            let itemText = item.textContent.toLowerCase().trim();
            item.classList.toggle('closed', !itemText.includes(inputValue.toLowerCase()));
        });
    };

    inputField.addEventListener('input', () => {
        filterItems(inputField.value);
        dropdown.classList.add('open');
    });

    dropdownItems.forEach(item => {
        item.addEventListener('click', () => {

            inputField.value = item.textContent.trim();
            inputHiddenField.value = item.dataset.id;
            dropdown.classList.remove('open');
            filterItems('');
            inputHiddenField.dispatchEvent(new Event('change'));
        });
    });

    inputField.addEventListener('focus', () => {
        inputField.placeholder = 'Поиск...';
        dropdown.classList.add('open');
        filterItems('');
    });

    inputField.addEventListener('blur-sm', () => {
        inputField.placeholder = inputField.getAttribute('data-placeholder');
        dropdown.classList.remove('open');
    });
}

let selectWrappers = document.querySelectorAll('.select-wrapper');
selectWrappers.forEach(initSelect);


export function callAddSelect(args, id) {
    let el = document.getElementById(args[3] + id);
    console.log(el, args[3] + id);
    initSelect(el);
}
