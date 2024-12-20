<header>
    <div class="upper-menu bg-[#FAFAFA] z-[82]">
        <div class="box-header-address bg-[#FAFAFA] z-[82]">
            <h2 class="header-address">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#820000" class="bi bi-geo-alt-fill me-2" viewBox="0 0 16 16">
                    <path d="M8 16s6-5.686 6-10A6 6 0 0 0 2 6c0 4.314 6 10 6 10m0-7a3 3 0 1 1 0-6 3 3 0 0 1 0 6"/>
                </svg>
                г. Мелитополь, пр. Б. Хмельницкого, д. 18
            </h2>
        </div>
        <div class="box-upper-nav bg-[#FAFAFA] z-[82]">
            <nav class="nav flex align-center">
                <a class="nav-link" href="#">Студенту</a>
                <a class="nav-link" href="#">Поступающим</a>
                <a class="nav-link" href="../views/view-aspirantam.html">Аспирантам</a>
                <a class="nav-link" href="#">Выпустникам</a>
                <a class="nav-link" href="#">Партнерам</a>
                <a class="nav-link btn-search cursor-pointer flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </a>
            </nav>
        </div>

    </div>
    <div class="search-box py-6">
        <div class="container custom">
            <div class="search-and-close-box mb-8">
                <h2 class="p-0">Поиск</h2>
                <span class="close-search"><i class="bi bi-x-lg me-2"></i>Закрыть</span>
            </div>
            <form class="search-form mb-8">
                <input class="form-control rounded-none" type="search" placeholder="Поиск" aria-label="Search">
                <button class="btn rounded-none text-white" type="submit">
                    Искать
                </button>
            </form>
            <div class="box-btns grid grid-cols-1 lg:grid-cols-[1fr,1fr,1fr,1fr] gap-3 text-center mb-8">
                <a class="btn-filter-search active uppercase py-[15px] px-[20px]">Искать везде</a>
                <a class="btn-filter-search uppercase py-[15px] px-[20px]">Новости</a>
                <a class="btn-filter-search uppercase py-[15px] px-[20px]">Структура сайта</a>
                <a class="btn-filter-search uppercase py-[15px] px-[20px]">Справочник</a>
            </div>
        </div>
    </div>
    <div class="main-menu">
        <div class="box-logo">
            <a href="#">
                <img src="{{asset('img/white-logo.png')}}" alt="Логотип университета">
            </a>
        </div>
        <div class="box-main-menu">
            <nav class="navbar">
                <button class="btn-search bg-[var(--primary-color)] min-h-[38px] min-w-[38px] flex items-center justify-center absolute right-[55px] top-[13px]">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </button>
                <button class="navbar-toggler items-end rounded-0  border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo2" aria-controls="navbarTogglerDemo2" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="box-hamburg">
                            <i class="bi bi-list"></i>
                        </span>
                </button>
                <div class="navbar-collapse">
                    <ul class="navbar-nav">
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">О МелГУ  <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">Образование <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">Наука <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">Молодежная политика <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">Доступная среда <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link flex justify-between lg:inline" href="#">Новости <i class="bi bi-chevron-right inline lg:hidden font-[600]"></i></a>
                        </li>
                    </ul>
                    <div class="search-and-btn-box">
                        <div class="personal-account-box">
                            <button class="personal-account-btn flex align-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                    <path fill-rule="evenodd" d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                                </svg>
                                <span>Личный кабинет</span>
                            </button>
                        </div>
                    </div>
                    <ul class="under-navbar-nav flex flex-col w-full lg:hidden">
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">О МелГУ</a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">Образование</a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">Наука</a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">Молодежная политика</a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">Доступная среда</a>
                        </li>
                        <li class="nav-item point-menu flex items-center">
                            <a class="nav-link" href="#">Новости</a>
                        </li>
                    </ul>
                </div>
            </nav>
            <div class="about-melsu-menu new-menu hidde">
                <div class="box-dropdown-btns">
                    <div class="box-back-btn">
                        <a class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="box-transit-btn">
                        <a class="transit-btn" href="../template/menu-page.html">
                            О МелГУ
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="wrapper-dropdown-menu">
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="education-melsu-menu new-menu hidde">
                <div class="box-dropdown-btns">
                    <div class="box-back-btn">
                        <a class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="box-transit-btn">
                        <a class="transit-btn">
                            Образование
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="wrapper-dropdown-menu">
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="science-melsu-menu new-menu hidde">
                <div class="box-dropdown-btns">
                    <div class="box-back-btn">
                        <a class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="box-transit-btn">
                        <a class="transit-btn">
                            Наука
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="wrapper-dropdown-menu">
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="youth-policy-melsu-menu new-menu hidde">
                <div class="box-dropdown-btns">
                    <div class="box-back-btn">
                        <a class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="box-transit-btn">
                        <a class="transit-btn">
                            Молодежная политика
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="wrapper-dropdown-menu">
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                </div>
            </div>
            <div class="ovz-melsu-menu new-menu hidde">
                <div class="box-dropdown-btns">
                    <div class="box-back-btn">
                        <a class="back-btn">
                            <i class="bi bi-arrow-left"></i>
                            Назад
                        </a>
                    </div>
                    <div class="box-transit-btn">
                        <a class="transit-btn">
                            Доступная среда
                            <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
                <div class="wrapper-dropdown-menu">
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                    <div class="box-dropdown-menu">
                        <nav class="nav">
                            <a class="nav-link" href="#">Студенту</a>
                            <a class="nav-link" href="#">Поступающим</a>
                            <a class="nav-link" href="#">Аспирантам</a>
                            <a class="nav-link" href="#">Выпустникам</a>
                            <a class="nav-link" href="#">Партнерам</a>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
