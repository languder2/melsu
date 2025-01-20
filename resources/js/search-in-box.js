if (document.querySelector('.parent')) {
    const parent = document.querySelector('.parent');
    const searchInput = document.getElementById('search-in-box');

    searchInput.addEventListener('input', function() {
        const searchTerm = (this.value || '').toLowerCase();

        Array.from(parent.querySelectorAll('.box-searching')).forEach((el) => {
            const nameText = (el.querySelector('.name')?.textContent || '').toLowerCase();
            const skuText = (el.querySelector('.sku')?.textContent || '').toLowerCase();
            const combinedText = nameText + skuText;

            let matcher;
            if (searchTerm) {
                matcher = new RegExp(searchTerm, 'gi');
            }


            const matchFound = matcher ? matcher.test(combinedText) : true;

            if (!matchFound) {
                el.style.display = 'none';
            } else {
                el.style.display = 'flex';
            }
        });
    });
}