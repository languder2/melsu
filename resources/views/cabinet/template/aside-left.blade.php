@hasSection('instruction')
    <aside class="left bg-neutral-150 w-96 2xl:w-1/5 border-r drop-shadow-md relative">
        <h3 class="font-semibold p-4 ">
            Инструкция
        </h3>
        <hr class="border-blue">
        <div class="absolute inset-0 top-15 overflow-y-scroll flex flex-col gap-4 p-4 ">
            @yield('instruction')
        </div>
    </aside>
@endif
