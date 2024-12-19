let menuPoints = document.querySelectorAll('.point-menu');
let dropDownMenus = document.querySelectorAll('.new-menu');
let content = document.querySelector('.main-section');
let navBar = document.querySelector('.navbar-collapse');
let btnSearch = document.querySelectorAll('.btn-search');
let searchBox = document.querySelector('.search-box');
let closeSeachBox = document.querySelector('.close-search');
let btnsFilterSearch = document.querySelectorAll('.btn-filter-search');
function checkScreenWidth() {
    if (window.matchMedia("(min-width: 1025px)").matches) {
        menuPoints.forEach((point, index) => {
            point.addEventListener('mouseover', () => {
                if (dropDownMenus[index]) {
                    dropDownMenus[index].classList.remove('hidde');
                    content.style.opacity = '0.3';
                    point.style.color = '#c10f1a';
                }
            });

            point.addEventListener('mouseleave', () => {
                if (dropDownMenus[index] && !dropDownMenus[index].contains(event.relatedTarget)) {
                    dropDownMenus[index].classList.add('hidde');
                    content.style.opacity = '1';
                    point.style.color = '#820000';
                }
            });
            if (dropDownMenus[index]) {
                dropDownMenus[index].addEventListener('mouseleave', () => {
                    dropDownMenus[index].classList.add('hidde');
                    content.style.opacity = '1';
                    point.style.color = '#820000';
                });
            }
        });
    } else {
        let hamburger = document.querySelector('.navbar-toggler');
        let backButtons = document.querySelectorAll('.back-btn');
        for (let i = 0; i < dropDownMenus.length; i++) {
            if (dropDownMenus[i]) {
                dropDownMenus[i].classList.remove('hidde');
                if(!dropDownMenus[i].classList.contains('mob-menu')){
                    dropDownMenus[i].classList.add('mob-menu');
                }
            }
        }
        hamburger.addEventListener('click', () => {
            if(searchBox.classList.contains('active')){
                searchBox.classList.remove('active');
                content.classList.remove('opacit');
                document.body.classList.remove('no-scroll');
            }
            navBar.classList.toggle('opened');
           document.body.classList.toggle('no-scroll');
            content.classList.toggle('opacit');
           for (let i = 0; i < dropDownMenus.length; i++) {
               if (dropDownMenus[i]) {
                   dropDownMenus[i].classList.remove('opened');
               }
           }
        });
        menuPoints.forEach((point, index) => {
            point.addEventListener('click', () => {
                dropDownMenus[index].classList.add('opened');
                document.body.classList.add('no-scroll');
            })
        });
        backButtons.forEach((btn, index) => {
            btn.addEventListener('click', () => {
                dropDownMenus[index].classList.remove('opened');
                document.body.classList.remove('no-scroll');
            })
        });
    }
}
btnSearch.forEach((point, index) => {
    point.addEventListener('click', () => {
        if(navBar.classList.contains('opened')){
            for (let i = 0; i < dropDownMenus.length; i++) {
                if (dropDownMenus[i]) {
                    dropDownMenus[i].classList.remove('opened');
                }
            }
            navBar.classList.remove('opened');
            document.body.classList.remove('no-scroll');
            content.classList.remove('opacit');
        }
        searchBox.classList.toggle('active');
        content.classList.toggle('opacit');
        document.body.classList.toggle('no-scroll');
    });
});
btnsFilterSearch.forEach((point, index) => {
    point.addEventListener('click', () => {
        btnsFilterSearch.forEach(btn => btn.classList.remove('active'));
        point.classList.add('active');
    });
});
closeSeachBox.addEventListener('click', () => {
    if(searchBox.classList.contains('active')){
        searchBox.classList.remove('active');
        content.classList.remove('opacit');
        document.body.classList.remove('no-scroll');
    }
});
document.addEventListener('click', (event) => {
    if (searchBox.classList.contains('active') && !searchBox.contains(event.target) && !Array.from(btnSearch).includes(event.target)) {
        closeAllSearch();
    }
});

function closeAllSearch () {
    if(searchBox.classList.contains('active')){
        searchBox.classList.remove('active');
        content.classList.remove('opacit');
        document.body.classList.remove('no-scroll');
        for (let i = 0; i < dropDownMenus.length; i++) {
            if (dropDownMenus[i]) {
                dropDownMenus[i].classList.remove('opened');
            }
        }
    }
    navBar.classList.remove('opened');
}
checkScreenWidth();
window.addEventListener('resize', checkScreenWidth);