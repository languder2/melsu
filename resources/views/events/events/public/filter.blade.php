<div class="grid grid-cols-1 lg:grid-cols-3 xl:grid-cols-4 mb-3 gap-5">
    <div>
        <input type="text" name="daterange" class="dataRange h-[48px] text-center py-3 px-[18px] bg-white" value="За все время">
    </div>
    <div class="select-wrapper relative max-w-full">
        <input type="text" class="input-hidden hidden">
        <input class="chosen-value relative top-0 left-0 w-full min-h-[48px] max-h-[48px] text-lg py-3 px-[18px] bg-white
                             transition duration-300 ease-in-out placeholder:text-[black] focus:border-b-[2px] outline-0 z-20"
               type="text" value="" placeholder="Выберите категорию">
        <ul class="value-list transition duration-300 ease-in-out absolute top-0 left-0 w-full max-h-0 cursor-pointer list-none mt-[48px] shadow-[2px_24px_17px_-13px_rgba(66, 68, 90, 1)] overflow-hidden
                [&.open]:max-h-[320px] [&.open]:overflow-auto z-20">
            <li data-id="1" class="drop-li min-h-[4rem] opacity-100 relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">
                Главное в МелГУ
            </li>
            <li data-id="2" class="drop-li min-h-[4rem] relative p-[1rem] bg-white text-lg flex items-center cursor-pointer transition duration-300 ease-in-out max-h-0 hover:bg-[#820000] hover:text-white
                                [&.closed]:max-h-0 [&.closed]:overflow-hidden [&.closed]:p-0 [&.closed]:opacity-0 [&.closed]:min-h-[0px]">
                Наука
            </li>
        </ul>
    </div>
    <div class="xl:col-span-2">
        <form class="h-[48px] flex justify-between">
            <input class="rounded-none search-field py-3 px-[18px] w-full lg:w-[90%] outline-0 bg-white" type="search"
                   placeholder="Поиск" aria-label="Search">
            <button class="btn search-btn rounded-none text-white bg-[var(--primary-color)] border-[1px] border-[var(--primary-color)] py-3 px-[18px]
                                       hover:bg-white hover:text-[var(--primary-color)]" type="submit">
                <i class="bi bi-search"></i>
            </button>
        </form>
    </div>
</div>
