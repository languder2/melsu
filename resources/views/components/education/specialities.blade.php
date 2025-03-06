<div class="box-heading container custom">
    <h2 class="font-bold text-2xl mb-3 ms-2 my-3">Направления подготовки</h2>
</div>
<section class="container custom lg:p-2.5">
    <div class="parent grid grid-cols-1 lg:grid-cols-[1fr_1fr] xl:grid-cols-[1fr_1fr_1fr] gap-3">
        @foreach($faculty->specialities as $speciality)
            <div
                class="
                    checked-box hidden
                    box-searching
                    card-nap
                    position-aware
                    lg:col-span-2
                    xl:col-span-1
                    lg:min-h-[240px]
                    xl:min-h-[300px]
                "
            >
                <input type="checkbox" class="speciality-ident hidden" checked>
                <a href="#" class="p-4 w-full">
                    <div>
                        <h2 class="text-xl font-[600] name mb-6 line-clamp-3">
                            {{$speciality->name}}
                        </h2>
                    </div>
                    <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3">
                        <div class="flex flex-col">
                            <span class="font-[400]">258</span>
                            <span class="font-[400] text-sm text-[#96918E]">Проходной балл</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-[400] text-sm">55</span>
                            <span class="font-[400] text-sm text-[#96918E]">Бюджетных мест</span>
                        </div>
                        <div class="flex flex-col">
                            <span class="font-[400] text-sm">5</span>
                            <span class="font-[400] text-sm text-[#96918E]">Срок обучения</span>
                        </div>
                    </div>
                    <span class="aware-bg"></span>
                </a>
            </div>
        @endforeach
    </div>
</section>


