if(document.querySelector('.parent')){
const parent = document.querySelector('.parent');
const searchInput = document.getElementById('search-in-box');


searchInput.addEventListener('input', function() {
    const matcher = new RegExp(this.value, 'gi');
    Array.from(parent.querySelectorAll('.box-searching')).forEach((el) => {
        if (!matcher.test(el.querySelector('.name').textContent + el.querySelector('.sku').textContent)) {
            el.style.display = 'none';
        } else {
            el.style.display = 'flex';
        }
    });
});
}