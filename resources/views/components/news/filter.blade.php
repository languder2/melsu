<div class="grid grid-cols-1 lg:grid-cols-4 gap-5 mt-[-270px] lg:mt-[-80px] relative z-10 mb-[60px] px-2.5 2xl:px-0">
    <div>
        <h3 class="text-white font-bold text-4xl">Новости</h3>
    </div>
    <div>
        <input type="text" name="daterange" class="dataRange h-[48px] text-center py-3 px-[18px] card-news-glass text-white border border-[#7D6C6D]" value="За все время">
    </div>

    <div class="select-wrapper relative max-w-full">
        <input type="text" class="input-hidden hidden">
        <input class="chosen-value card-news-glass border border-[#7D6C6D] border-b-0 relative top-0 left-0 w-full min-h-[48px] max-h-[48px] text-lg py-3 px-[18px]
                            transition duration-300 ease-in-out placeholder:text-white text-white focus:border-b-[2px] outline-0 z-20"
                type="text" value="{{ $category->name }}" placeholder="Выберите категорию">
        <ul class="value-list news-value card-news-glass bg-transparent border border-[#7D6C6D] border-t-0 transition duration-300 ease-in-out absolute top-0 left-0 w-full max-h-0 cursor-pointer list-none mt-[48px] shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)] overflow-hidden
                [&.open]:max-h-[320px] [&.open]:overflow-auto z-20">

                <li data-id="" class="drop-li card-news-glass text-white min-h-[4rem] opacity-100 relative p-[1rem] text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#212121b9] hover:text-white
                                    [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]"
                    onclick="location.href='{{ route('news:show:all') }}'"
                >
                    Все
                </li>


            @foreach($categories as $category)
                <li data-id="{{ $category->id }}" class="drop-li min-h-[4rem] opacity-100 relative p-[1rem] card-news-glass text-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#212121b9] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]"
                    onclick="location.href='{{ $category->link }}'"
                >
                    {!! $category->name !!}
                </li>
            @endforeach
        </ul>
    </div>
    <div class="">
        <form action="{{ route('news:public:set-filter') }}" class="h-[48px] flex justify-between" method="POST">
            @csrf
            <input class="rounded-none card-news-glass border border-[#7D6C6D] search-field py-3 px-[18px] w-full lg:w-[90%] outline-0 text-white placeholder:text-white" type="search"
                placeholder="Поиск" aria-label="Search" name="search" value="{{ $search ?? null }}">
            <button class="btn search-btn rounded-none text-white card-news-glass border-[1px] border-[#7D6C6D] py-3 px-[18px]
                    hover:bg-white hover:text-[var(--primary-color)]" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>
<style>
    .daterangepicker .drp-calendar.right {
    position: absolute !important;
    right: 0 !important;
    top: 0 !important;
}
.daterangepicker.ltr{
    background: rgba(0, 0, 0, 0.25);
    box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
    backdrop-filter: blur(4.4px);
    -webkit-backdrop-filter: blur(4.4px);
    border-color: #7D6C6D;
}
.calendar-table{
    background-color: transparent !important;
    border: none !important;
}
.table-condensed{
    color: white !important;
}
.daterangepicker .calendar-table .next span, .daterangepicker .calendar-table .prev span{
    border-color: white !important;
}
.daterangepicker .drp-calendar.right tbody {
    display: none !important;
}

.daterangepicker .drp-calendar.right thead > tr:nth-child(2) {
    display: none !important;
}

.daterangepicker .drp-calendar.right th.month {
    display: none !important;
}

.daterangepicker .drp-calendar.right .calendar-table {
    background: transparent !important;
}

.daterangepicker .daterangepicker.ltr .ranges, .daterangepicker.ltr .drp-calendar {
    float: none !important;
}

.daterangepicker .drp-calendar.right .daterangepicker_input {
    position: absolute !important;
}
.drp-calendar.left .calendar-table{
    padding-right: 0 !important;
}
.dataRange{
    width: 100%;
}
.daterangepicker.ltr.show-calendar.openscenter{
    width: 270px;
}
.drp-buttons{
    display: flex !important;
    justify-content: center !important;
}
.daterangepicker .drp-buttons .btn{
    color: #4C4C4C !important;
    background-color: #F0F0F0;
}
.drp-calendar.left{
    padding-right: 10px !important;
}
.drp-selected{
    display: none !important;
}
.daterangepicker td{
    font-size: 12px !important;
}

.daterangepicker .calendar-table tr:nth-child(2) th{
    font-weight: 500 !important;
}
.daterangepicker td.active, .daterangepicker td.active:hover{
    background: rgba(0, 0, 0, 0.25);
    border-radius: none !important;
}
.daterangepicker td.off, .daterangepicker td.off.in-range, .daterangepicker td.off.start-date, .daterangepicker td.off.end-date{
    background-color: transparent !important;
}
.daterangepicker td.available:hover, .daterangepicker th.available:hover,.daterangepicker td.in-range {
    background: rgba(0, 0, 0, 0.25);
    border-color: transparent;
    color: white !important;
}
.daterangepicker .drp-buttons .btn{
    color: white !important;
}
</style>
