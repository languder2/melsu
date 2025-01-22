<header>
    @if(request()->session()->get('show-video') === null )
        <div class="wrapper-video">
            <video id="intro-video" autoplay muted>
                <source src="{{asset('video/2kk.webm')}}" type="video/webm">
            </video>
        </div>
        @php(session(['show-video' => time()]))
    @endif

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

                <x-menu.topmenu />

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

    <x-menu.mainmenu />
</header>
