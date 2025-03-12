if (document.querySelector('.main-menu')) {
    let menuPoints = document.querySelectorAll('.point-menu');
    let dropDownMenus = document.querySelectorAll('.new-menu');
    let content = document.querySelector('.main-section');
    let navBar = document.querySelector('.navbar-collapse');
    let btnSearchPc = document.querySelector('.box-upper-nav .btn-search');
    let btnSearchMob = document.querySelector('.navbar .btn-search');
    let searchBox = document.querySelector('.search-box');
    let closeSearchBox = document.querySelector('.close-search');
    let btnsFilterSearch = document.querySelectorAll('.btn-filter-search');
    let searchContent = document.querySelector('.search-box .container');
    let SearchHeight = searchContent.getBoundingClientRect().height;
    let navbarCollapseContent = document.querySelector('.navbar-collapse .navbar-nav');
    let navbarCollapseHeight = navbarCollapseContent.getBoundingClientRect().height;
    let underNavBarContent = document.querySelector('.navbar-collapse .navbar-nav');
    let underNavBarHeight = underNavBarContent.getBoundingClientRect().height;
    let aminBtn = document.querySelector('.excursion-btn');

    function checkScreenWidth() {
        if (window.matchMedia("(min-width: 1025px)").matches) {
            navBar.style.height = '110px';
            menuPoints.forEach((point, index) => {
                point.addEventListener('mouseover', () => {
                    dropDownMenus.forEach((item) => {
                        if (point.getAttribute('data-menu') === item.id) {
                            item.classList.remove('hidde');
                            content.style.opacity = '0.3';
                            point.style.color = '#c10f1a';
                        }
                    });

                });

                point.addEventListener('mouseleave', () => {
                    dropDownMenus.forEach((item) => {
                        if (point.getAttribute('data-menu') === item.id && !item.contains(event.relatedTarget)) {
                            item.classList.add('hidde');
                            content.style.opacity = '1';
                            point.style.color = '#820000';
                        }
                    });
                });
                dropDownMenus.forEach((item) => {
                    if (point.getAttribute('data-menu') === item.id) {
                        item.addEventListener('mouseleave', () => {
                            item.classList.add('hidde');
                            content.style.opacity = '1';
                            point.style.color = '#820000';
                        });
                    }
                });
            });
            //search
            btnSearchPc.addEventListener('click', () => {
                if (navBar.classList.contains('opened')) {
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
                aminBtn.classList.toggle('close');
                content.classList.toggle('opacit');
                document.body.classList.toggle('no-scroll');
                if (searchBox.classList.contains('active') && window.matchMedia("(min-width: 1025px)").matches) {
                    let searchBoxActive = document.querySelector('.search-box.active');
                    searchBoxActive.style.height = 311 + 'px';
                } else {
                    searchBox.style.height = '0px';
                }
                if (searchBox.classList.contains('active') && window.matchMedia("(max-width: 1024px)").matches) {
                    let searchBoxActive = document.querySelector('.search-box.active');
                    searchBoxActive.style.height = SearchHeight + 'px';
                    navBar.style.height = '0px';
                }
            });
        } else {
            let hamburger = document.querySelector('.navbar-toggler');
            let backButtons = document.querySelectorAll('.back-btn');
            for (let i = 0; i < dropDownMenus.length; i++) {
                if (dropDownMenus[i]) {
                    dropDownMenus[i].classList.remove('hidde');
                    if (!dropDownMenus[i].classList.contains('mob-menu')) {
                        dropDownMenus[i].classList.add('mob-menu');
                    }
                }
            }
            hamburger.addEventListener('click', () => {
                if (searchBox.classList.contains('active')) {
                    searchBox.classList.remove('active');
                    content.classList.remove('opacit');
                    document.body.classList.remove('no-scroll');
                }
                navBar.classList.toggle('opened');
                document.body.classList.toggle('no-scroll');
                content.classList.toggle('opacit');
                if (navBar.classList.contains('opened')) {
                    let navbarCollapseOpened = document.querySelector('.navbar-collapse.opened');
                    navbarCollapseOpened.style.height = underNavBarHeight + 56.5 + 'px';
                    searchBox.style.height = '0px';
                } else {
                    navBar.style.height = '0px';
                }
                for (let i = 0; i < dropDownMenus.length; i++) {
                    if (dropDownMenus[i]) {
                        dropDownMenus[i].classList.remove('opened');
                    }
                }
            });
            menuPoints.forEach((point, index) => {
                point.addEventListener('click', () => {
                    dropDownMenus.forEach((item) => {
                        if (point.getAttribute('data-menu') === item.id) {
                            item.classList.add('opened');
                            document.body.classList.add('no-scroll');
                        }
                    });
                })
            });
            backButtons.forEach((btn, index) => {
                btn.addEventListener('click', () => {
                    if (dropDownMenus[index]) {
                        dropDownMenus[index].classList.remove('opened');
                        document.body.classList.remove('no-scroll');
                    }
                })
            });
            //search mob
            btnSearchMob.addEventListener('click', () => {
                if (navBar.classList.contains('opened')) {
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
                if (searchBox.classList.contains('active') && window.matchMedia("(min-width: 1025px)").matches) {
                    let searchBoxActive = document.querySelector('.search-box.active');
                    searchBoxActive.style.height = 311 + 'px';
                } else {
                    searchBox.style.height = '0px';
                }
                if (searchBox.classList.contains('active') && window.matchMedia("(max-width: 1024px)").matches) {
                    let searchBoxActive = document.querySelector('.search-box.active');
                    searchBoxActive.style.height = SearchHeight + 'px';
                    navBar.style.height = '0px';
                }
            });
        }
    }

    btnsFilterSearch.forEach((point, index) => {
        point.addEventListener('click', () => {
            btnsFilterSearch.forEach(btn => btn.classList.remove('active'));
            point.classList.add('active');
        });
    });
    closeSearchBox.addEventListener('click', () => {
        if (searchBox.classList.contains('active')) {
            searchBox.classList.remove('active');
            aminBtn.classList.remove('close');
            content.classList.remove('opacit');
            document.body.classList.remove('no-scroll');
            searchBox.style.height = '0px';
        }
    });
    document.addEventListener('click', (event) => {
        if (searchBox.classList.contains('active') && !searchBox.contains(event.target) && !event.target.closest('.btn-search')) {
            console.log('Закрываем поиск');
            closeAllSearch();
        }
    });

    function resizeMenu() {
        let searchContent = document.querySelector('.search-box .container');
        let SearchHeight = searchContent.getBoundingClientRect().height;
        if (searchBox.classList.contains('active')) {
            let searchBoxActive = document.querySelector('.search-box.active');
            searchBoxActive.style.height = SearchHeight + 'px';
        } else {
            searchBox.style.height = '0px';
        }
        let navbarCollapseContent = document.querySelector('.navbar-collapse .navbar-nav');
        let navbarCollapseHeight = navbarCollapseContent.getBoundingClientRect().height;
        if (navBar.classList.contains('opened')) {
            let navbarCollapseOpened = document.querySelector('.navbar-collapse.opened');
            navbarCollapseOpened.style.height = navbarCollapseHeight + 56.5 + 'px';
        } else {
            navBar.style.height = '0px';
        }
    }

    function closeAllSearch() {
        if (searchBox.classList.contains('active')) {
            searchBox.classList.remove('active');
            aminBtn.classList.remove('close');
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
}
