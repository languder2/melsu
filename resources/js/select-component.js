function initSelect(selectWrapper) {
    const inputField = selectWrapper.querySelector('.chosen-value');
    const inputHiddenField = selectWrapper.querySelector('.input-hidden');
    const dropdown = selectWrapper.querySelector('.value-list');
    const dropdownItems = [...dropdown.querySelectorAll('.drop-li')];

    const filterItems = (inputValue) => {
        dropdownItems.forEach(item => {
            const itemText = item.textContent.toLowerCase();
            item.classList.toggle('closed', !itemText.startsWith(inputValue.toLowerCase()));
        });
    };

    inputField.addEventListener('input', () => {
        filterItems(inputField.value);
        dropdown.classList.add('open');
    });

    dropdownItems.forEach(item => {
        item.addEventListener('click', () => {
            inputField.value = item.textContent;
            inputHiddenField.value = item.dataset.id;
            dropdown.classList.remove('open');
            filterItems('');
        });
    });

    inputField.addEventListener('focus', () => {
        inputField.placeholder = 'Поиск...';
        dropdown.classList.add('open');
        filterItems('');
    });

    inputField.addEventListener('blur', () => {
        inputField.placeholder = 'Выберите категорию';
        dropdown.classList.remove('open');
    });
}

const selectWrappers = document.querySelectorAll('.select-wrapper');
selectWrappers.forEach(initSelect);