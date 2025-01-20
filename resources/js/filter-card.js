if(document.querySelectorAll('.btn-filter-card')){
    var btnFilterCard = document.querySelectorAll('.btn-filter-card');
    var btnShowFilter = document.querySelector('.btn-show-filter');
    var filterShowBox = document.querySelector('.box-show-filter');
    var  filterSelectBox= document.querySelector('.filters-select-box');
}


btnFilterCard.forEach((point, index) => {
    point.addEventListener('click', () => {
        btnFilterCard.forEach(btn => btn.classList.remove('active'));
        point.classList.add('active');
    });
});

if(btnShowFilter !== null)
    btnShowFilter.addEventListener('click', () =>{
        filterShowBox.classList.add('hidde');
        filterSelectBox.classList.remove('hidden');
    })
