<section>
    <h2 class="font-bold text-3xl mb-3 mt-8">О программе</h2>
    <div class="bg-white p-6">
        <div class="prog-info text-xl line-clamp-4">
            @foreach($speciality->sections as $section)
                {!! $section->content !!}
            @endforeach
        </div>

        <div class="text-right mt-3">
            <a class="more-prog-btn text-md sm:text-lg border-b-2 border-[#474747] hover:opacity-80 transition duration-300 ease-linear uppercase pb-2 col-span-2 order-3 w-fit mt-3 cursor-pointer">
                Подробнее о программе
            </a>
        </div>
</div>
</section>
