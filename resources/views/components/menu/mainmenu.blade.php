<div class="main-menu">
    <div class="box-logo">
        <a href="{{url('/')}}">
            <img src="{{asset('img/white-logo.png')}}" alt="Логотип университета">
        </a>
    </div>
    <div class="box-main-menu">
        <nav class="navbar">
            <button
                class="btn-search bg-[var(--primary-color)] min-h-[38px] min-w-[38px] items-center justify-center absolute right-[55px] top-[26px] hidden">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
            <button class="navbar-toggler items-end rounded-0  border-0 flex" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo2" aria-controls="navbarTogglerDemo2" aria-expanded="false"
                    aria-label="Toggle navigation">
                        <span class="box-hamburg">
                            <span></span>
                            <span></span>
                            <span></span>
                        </span>
            </button>

            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    @foreach($MainMenu->subs as $menu)
                        <li
                            data-menu="menu_{{$menu->id}}"
                            class="nav-item point-menu flex items-center justify-between lg:justify-start"
                        >
                            <a
                                class="
                                    nav-link
                                    hidden lg:block
                                "
                                href="{{$menu->link}}"
                            >
                                {{$menu->name}}
                            </a>


                            <span
                                class="
                                    nav-link
                                    lg:hidden
                                "
                            >
                                {{$menu->name}}
                            </span>
                            <span class="lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#820000" stroke-width="1.5" stroke="#820000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </span>
                        </li>
                    @endforeach
                </ul>

                <div class="excursion-btn">
                    <div class="excursion-menu-box">
                        <div class="excursion-menu hidden">
                            <h1>МелГУ - где это:</h1>
                            <ul>
                                <li><a href="#">Новороссия</a></li>
                                <li><a href="#">Запорожская область</a></li>
                                <li><a href="#">Мелитополь</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="flex justify-between relative">
                        <a href="https://melsu.ru/melsu-this-is" class="modal-open">Начни с меня</a>
                        <video id="anim-logo" autoplay loop muted>
                            <source src="{{asset('video/anim-logo.webm')}}" type="video/webm">

                        </video>
                    </div>
                </div>
                <div class="search-and-btn-box">
                    <div class="search-in-menu p-[15px] flex items-center gap-3">
                        <div class="bvi-shortcode border-r pr-2.5">
                            <a href="#" class="bvi-open flex items-center gap-2 text-xl text-[#820000]">
                                <svg aria-hidden="true" width="25" height="25" focusable="false" role="img" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512" class="bvi-svg-eye">
                                    <path fill="currentColor" d="M572.52 241.4C518.29 135.59 410.93 64 288 64S57.68 135.64 3.48 241.41a32.35 32.35 0 0 0 0 29.19C57.71 376.41 165.07 448 288 448s230.32-71.64 284.52-177.41a32.35 32.35 0 0 0 0-29.19zM288 400a144 144 0 1 1 144-144 143.93 143.93 0 0 1-144 144zm0-240a95.31 95.31 0 0 0-25.31 3.79 47.85 47.85 0 0 1-66.9 66.9A95.78 95.78 0 1 0 288 160z" class="bvi-svg-eye">
                                    </path>
                                </svg>
                                Версия для слабовидящих
                            </a>
                        </div>
                        <div>
                            <button class="btn-search  min-h-[38px] min-w-[38px] items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="#820000" class="bi bi-search" viewBox="0 0 16 16">
                                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center justify-between w-full pr-[15px] border-b border-[#E6E6E6]">
                        <a href="https://abiturient.mgu-mlt.ru" class="text-xl p-[15px] flex items-center gap-1 text-[#820000]">
                            Поступающему
                            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-mortarboard" viewBox="0 0 16 16">
                                <path d="M8.211 2.047a.5.5 0 0 0-.422 0l-7.5 3.5a.5.5 0 0 0 .025.917l7.5 3a.5.5 0 0 0 .372 0L14 7.14V13a1 1 0 0 0-1 1v2h3v-2a1 1 0 0 0-1-1V6.739l.686-.275a.5.5 0 0 0 .025-.917zM8 8.46 1.758 5.965 8 3.052l6.242 2.913z"/>
                                <path d="M4.176 9.032a.5.5 0 0 0-.656.327l-.5 1.7a.5.5 0 0 0 .294.605l4.5 1.8a.5.5 0 0 0 .372 0l4.5-1.8a.5.5 0 0 0 .294-.605l-.5-1.7a.5.5 0 0 0-.656-.327L8 10.466zm-.068 1.873.22-.748 3.496 1.311a.5.5 0 0 0 .352 0l3.496-1.311.22.748L8 12.46z"/>
                            </svg>
                        </a>
                        <span class="lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#820000" stroke-width="1.5" stroke="#820000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </span>
                    </div>
                    <div class="personal-account-box border-b w-full flex items-center justify-between pr-[15px]">
                        <button class="personal-account-btn align-center">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
                                 class="bi bi-box-arrow-in-right" viewBox="0 0 16 16">
                                <path fill-rule="evenodd"
                                      d="M6 3.5a.5.5 0 0 1 .5-.5h8a.5.5 0 0 1 .5.5v9a.5.5 0 0 1-.5.5h-8a.5.5 0 0 1-.5-.5v-2a.5.5 0 0 0-1 0v2A1.5 1.5 0 0 0 6.5 14h8a1.5 1.5 0 0 0 1.5-1.5v-9A1.5 1.5 0 0 0 14.5 2h-8A1.5 1.5 0 0 0 5 3.5v2a.5.5 0 0 0 1 0z"/>
                                <path fill-rule="evenodd"
                                      d="M11.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L10.293 7.5H1.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708z"/>
                            </svg>
                            <span>Личный кабинет</span>
                        </button>
                        <span class="lg:hidden">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#820000" stroke-width="1.5" stroke="#820000" class="bi bi-chevron-right" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M4.646 1.646a.5.5 0 0 1 .708 0l6 6a.5.5 0 0 1 0 .708l-6 6a.5.5 0 0 1-.708-.708L10.293 8 4.646 2.354a.5.5 0 0 1 0-.708"/>
                                </svg>
                            </span>
                    </div>
                </div>
            </div>
        </nav>
        @foreach($MainMenu->subs as $menu)
            @if($menu->items->count())
                <div id="menu_{{$menu->id}}" class="new-menu hidde">
                    <div class="box-dropdown-btns">
                        <div class="box-back-btn">
                            <a class="back-btn">
                                <i class="bi bi-arrow-left"></i>
                                Назад
                            </a>
                        </div>
                        <div class="">
                            <div class="">
                                <a
                                    class="inline-block hover:bg-base-red hover:text-white rounded-md justify-center align-center"
                                    href="{{url($menu->link)}}"
                                >
                                    <p class="flex gap-2 group py-2 px-4 text-xl">
                                        <span
                                            class="
                                                inline-block w-5 h-5
                                                stroke-base-red fill-base-red group-hover:stroke-white group-hover:fill-white
                                                transition-all duration-200
                                            "
                                        >
                                            {!! @file_get_contents(public_path($menu->ico->image)) !!}
                                        </span>
                                        {{$menu->name}}
                                        <i class="bi bi-box-arrow-up-right text-sm"></i>

                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="wrapper-dropdown-menu">
                        @foreach($menu->items as $group)
                            <div class="box-dropdown-menu">
                                <nav class="nav">
                                    @foreach($group->subs as $item)
                                        <a
                                            class="nav-link text-lg lg:text-[15px]"
                                            href="{{$item->link??'#'}}"
                                        >
                                            {{$item->name}}
                                        </a>
                                    @endforeach
                                </nav>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        @endforeach
    </div>
</div>
