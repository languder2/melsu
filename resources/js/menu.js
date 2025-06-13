if (document.querySelector('.main-menu')) {
    const elements = {
        menuPoints: document.querySelectorAll('.point-menu'),
        dropDownMenus: document.querySelectorAll('.new-menu'),
        content: document.querySelector('.main-section') || document.querySelector('.main-content'),
        navBar: document.querySelector('.navbar-collapse'),
        btnSearchPc: document.querySelector('.box-upper-nav .btn-search'),
        btnSearchMob: document.querySelector('.navbar .btn-search'),
        searchBox: document.querySelector('.search-box'),
        closeSearchBox: document.querySelector('.close-search'),
        btnsFilterSearch: document.querySelectorAll('.btn-filter-search'),
        searchContent: document.querySelector('.search-box .container'),
        navbarCollapseContent: document.querySelector('.navbar-collapse .navbar-nav'),
        aminBtn: document.querySelector('.excursion-btn'),
        hamburger: document.querySelector('.navbar-toggler'),
        backButtons: document.querySelectorAll('.back-btn')
    };

    let state = {
        isMobile: window.innerWidth <= 1024,
        searchHeight: 0,
        navbarHeight: 0,
        menuOpened: false,
        searchOpened: false
    };

    function initSizes() {
        state.searchHeight = elements.searchContent?.offsetHeight || 0;
        if (state.isMobile) {
            state.navbarHeight = elements.navbarCollapseContent?.offsetHeight + 56.5 || 0;
        }
    }

    function toggleMobileMenu() {
        state.menuOpened = !state.menuOpened;
        closeAllDropdowns();

        requestAnimationFrame(() => {
            elements.navBar.classList.toggle('opened', state.menuOpened);
            document.body.classList.toggle('no-scroll', state.menuOpened);
            elements.content.classList.toggle('opacit', state.menuOpened);

            if (state.menuOpened) {
                elements.navBar.style.height = `${state.navbarHeight}px`;
                elements.searchBox.style.height = '0';
                closeAllDropdowns();
                closeSearch();
            } else {
                elements.navBar.style.height = '0';
            }
        });
    }

    function closeAllDropdowns() {
        elements.dropDownMenus.forEach(menu => {
            menu.classList.remove('opened');
        });
    }

    function setupHamburger() {
        if (!elements.hamburger) return;

        elements.hamburger.addEventListener('click', (e) => {
            e.stopPropagation();

            if (state.searchOpened) {
                closeSearch();
                setTimeout(toggleMobileMenu, 100);
            } else {
                toggleMobileMenu();
            }
        });
    }

    function toggleSearch() {
        state.searchOpened = !state.searchOpened;

        requestAnimationFrame(() => {
            elements.searchBox.classList.toggle('active', state.searchOpened);
            elements.aminBtn?.classList.toggle('close', state.searchOpened);
            elements.content.classList.toggle('opacit', state.searchOpened);
            document.body.classList.toggle('no-scroll', state.searchOpened || state.menuOpened);

            if (state.searchOpened) {
                const currentSearchHeight = elements.searchContent?.offsetHeight || 0;
                elements.searchBox.style.height = state.isMobile ? `${currentSearchHeight}px` : '311px';
                if (state.isMobile && state.menuOpened) {
                    toggleMobileMenu();
                }
            } else {
                elements.searchBox.style.height = '0';
            }
        });
    }

    function closeSearch() {
        if (!state.searchOpened) return;

        state.searchOpened = false;
        elements.searchBox.classList.remove('active');
        elements.aminBtn?.classList.remove('close');
        elements.content.classList.remove('opacit');
        if (!state.menuOpened) {
            document.body.classList.remove('no-scroll');
        }
        elements.searchBox.style.height = '0';
    }

    function setupSearch() {
        const searchBtn = state.isMobile ? elements.btnSearchMob : elements.btnSearchPc;

        if (!searchBtn) return;

        searchBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            toggleSearch();
            closeAllDropdowns();
        });

        elements.closeSearchBox?.addEventListener('click', function(e) {
            e.stopPropagation();
            closeSearch();
        });

        document.addEventListener('click', function(e) {
            if (state.searchOpened &&
                !elements.searchBox.contains(e.target) &&
                !(state.isMobile ? elements.btnSearchMob : elements.btnSearchPc).contains(e.target)) {
                closeSearch();
            }
        });
    }

    function setupMobileMenu() {
        elements.dropDownMenus.forEach(menu => {
            menu.classList.remove('hidde');
            menu.classList.add('mob-menu');
        });

        elements.menuPoints.forEach(point => {
            point.addEventListener('click', (e) => {
                e.stopPropagation();
                const menuId = point.getAttribute('data-menu');
                const menu = document.getElementById(menuId);
                if (menu) {
                    menu.classList.add('opened');
                    document.body.classList.add('no-scroll');
                }
            });
        });

        elements.backButtons.forEach(btn => {
            btn.addEventListener('click', (e) => {
                e.stopPropagation();
                const menu = btn.closest('.mob-menu');
                if (menu) {
                    menu.classList.remove('opened');
                    document.body.classList.remove('no-scroll');
                }
            });
        });
    }

    function setupDesktopDropdowns() {
        if (state.isMobile) return;

        elements.menuPoints.forEach(point => {
            point.addEventListener('mouseenter', () => {
                const menuId = point.getAttribute('data-menu');
                const dropdown = document.getElementById(menuId);
                if (dropdown) {
                    closeAllDropdowns();
                    dropdown.classList.remove('hidde');
                    dropdown.classList.add('opened');
                }
            });

            point.addEventListener('mouseleave', () => {
                const menuId = point.getAttribute('data-menu');
                const dropdown = document.getElementById(menuId);
                if (dropdown && dropdown.classList.contains('opened')) {
                    dropdown.classList.remove('opened');
                    dropdown.classList.add('hidde');
                }
            });
        });

        elements.dropDownMenus.forEach(menu => {
            menu.addEventListener('mouseenter', () => {
                menu.classList.remove('hidde');
                menu.classList.add('opened');
            });
            menu.addEventListener('mouseleave', () => {
                menu.classList.remove('opened');
                menu.classList.add('hidde');
            });
        });
    }

    function setupOutsideClickHandler() {
        document.addEventListener('click', (e) => {
            if (state.menuOpened &&
                !elements.navBar.contains(e.target) &&
                !elements.hamburger.contains(e.target)) {
                toggleMobileMenu();
                closeAllDropdowns();
            }
        });
    }

    function handleResize() {
        const newIsMobile = window.innerWidth <= 1024;
        if (newIsMobile !== state.isMobile) {
            state.isMobile = newIsMobile;
            initSizes();
            if (state.isMobile) {
                setupMobileMenu();
                elements.menuPoints.forEach(point => {
                    point.removeEventListener('mouseenter', null);
                    point.removeEventListener('mouseleave', null);
                });
                elements.dropDownMenus.forEach(menu => {
                    menu.removeEventListener('mouseenter', null);
                    menu.removeEventListener('mouseleave', null);
                });
            } else {
                setupDesktopDropdowns();
                elements.dropDownMenus.forEach(menu => {
                    menu.classList.remove('mob-menu');
                });
            }
        }
    }

    function init() {
        initSizes();
        setupSearch();
        if (state.isMobile) {
            setupMobileMenu();
            setupHamburger();
            setupOutsideClickHandler();
        } else {
            setupDesktopDropdowns();
        }

        const debouncedResize = debounce(handleResize, 100);
        window.addEventListener('resize', debouncedResize);
    }

    function debounce(func, wait) {
        let timeout;
        return function() {
            clearTimeout(timeout);
            timeout = setTimeout(() => func.apply(this, arguments), wait);
        };
    }

    function adjustPaddingForIOS() {
        const isIOS = /iPad|iPhone|iPod/.test(navigator.userAgent) && !window.MSStream;
        const iOSPadding = '100px';

        if (isIOS) {
            const dropdownMenu = document.querySelectorAll('.wrapper-dropdown-menu');
            if (dropdownMenu) {
                dropdownMenu.forEach(wrap => {
                    const lastBox = wrap.querySelector('.box-dropdown-menu:last-child');
                    if (lastBox) {
                        lastBox.style.paddingBottom = iOSPadding;
                    }
                })
            }
        }
    }

    document.addEventListener('DOMContentLoaded', adjustPaddingForIOS);
    window.addEventListener('resize', adjustPaddingForIOS);

    init();
}
