<div class="main-menu">
    <div class="box-logo">
        <a href="{{url('/')}}">
            <img src="{{asset('img/white-logo.png')}}" alt="Логотип университета">
        </a>
    </div>
    <div class="box-main-menu">
        <nav class="navbar">
            <button
                class="btn-search bg-[var(--primary-color)] min-h-[38px] min-w-[38px] items-center justify-center absolute right-[55px] top-[13px]">
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-search"
                     viewBox="0 0 16 16">
                    <path
                        d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                </svg>
            </button>
            <button class="navbar-toggler items-end rounded-0  border-0" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarTogglerDemo2" aria-controls="navbarTogglerDemo2" aria-expanded="false"
                    aria-label="Toggle navigation">
                        <span class="box-hamburg">
                            <i class="bi bi-list"></i>
                        </span>
            </button>

            <div class="navbar-collapse">
                <ul class="navbar-nav">
                    @foreach($MainMenu->subs as $menu)
                        <li
                            data-menu="menu_{{$menu->id}}"
                            class="nav-item point-menu flex items-center"
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
                    <div class="personal-account-box">
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
                                    class="inline-block py-2 px-4 hover:bg-base-red hover:text-white rounded-md justify-center align-center"
                                    href="{{url($menu->link)}}"
                                >
                                    <p class="flex gap-2 group">
                                        <span
                                            class="
                                                inline-block w-5 h-5
                                                stroke-neutral-700 fill-neutral-700 group-hover:stroke-white group-hover:fill-white
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
                                            class="nav-link"
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
