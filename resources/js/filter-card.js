document.addEventListener('DOMContentLoaded', () => {
    let list = document.querySelectorAll('.specialities_filter');

    if (!list) return;

    list.forEach((el) => {
            let form = el.closest('form');
            if(!form) return;

            let groupSearch = form.getAttribute('data-group-search');
            let noSearch = form.getAttribute('data-no-search');
            let cards = document.querySelectorAll(groupSearch);

            el.addEventListener('change', () => {

                let formData = new FormData(form);

                formData.forEach((value, field) => {
                    let type = form.querySelector('[name="' + field + '"]')
                        .getAttribute('data-filter-type');

                    if (type === 'check' && value !== '') {
                        check(cards, field, value);
                    }

                    if (type === 'search' && value !== '') {
                        search(cards, value);
                    }
                });

                checkResults(groupSearch, noSearch)
            })
    });

    function showAll(cards) {
        cards.forEach((card) => {
            card.setAttribute('checked', 'true');
        })
    }

    function check(cards, field, value) {
        Array.from(cards)
            .filter(element => element.dataset[field] !== value)
            .forEach(card => card.removeAttribute('checked'))
    }

    function search(cards, value) {
        Array.from(cards)
            .filter(element => !element.value.includes(value))
            .forEach(card => card.removeAttribute('checked'))
    }

    function checkResults(groupClass, messageClass) {
        let list = document.querySelectorAll(groupClass + ':checked');

        let MessageBlock = document.querySelector(messageClass);

        if (!MessageBlock) return false;

        if (list.length)
            MessageBlock.classList.add('hidden')
        else
            MessageBlock.classList.remove('hidden')
    }

    if(document.querySelector('.btn-show-filter'))
        document.querySelector('.btn-show-filter').addEventListener('click', () => {
            document.querySelector('.box-show-filter').classList.add('hidden');
            document.querySelector('.filters-select-box').classList.remove('hidden');
        })

    let searchInput = document.querySelectorAll('[data-filter-type="search"]');

    if (!searchInput) return false;

    searchInput.forEach((el) => {
        el.addEventListener('keydown', () => el.dispatchEvent(new Event('change')));
    });

});
