<div>
    <h2 class="font-bold text-2xl my-6">
        {{$group->name}}
    </h2>

    @foreach($group->list as $key=>$post)
        <div
            class="grid grid-cols-1 lg:grid-cols-[33%_33%_33%] gap-1 mb-[20px] lg:mb-[4px] border  border-[lightgray] lg:border-none">
            <div
                class="p-2.5 flex lg:justify-left order-0 items-center bg-[var(--primary-color)] @if($key !== 0) lg:hidden @endif">
                <span class="font-bold text-white">Название центра</span>
            </div>
            <div
                class="p-2.5 flex lg:justify-left order-2 items-center bg-[var(--primary-color)] @if($key !== 0) lg:hidden @endif">
                <span class="font-bold text-white">ФИО Начальника</span>
            </div>
            <div
                class="p-2.5 flex lg:justify-left order-3 items-center bg-[var(--primary-color)] @if($key !== 0) lg:hidden @endif">
                <span class="font-bold text-white">Адрес</span>
            </div>

            <div class="bg-white p-2.5 flex lg:justify-left items-center order-1 lg:order-4">
                <span class="ps-3 lg:ps-0">
                    {{$post->department}}
                </span>
            </div>
            <div class="bg-white p-2.5 flex lg:justify-left items-center order-2 lg:order-5">
                <span class="ps-3 lg:ps-0">
                    {{$post->lastname}}
                    {{$post->firstname}}
                    {{$post->middlename}}
                </span>
            </div>
            <div class="bg-white p-2.5 flex lg:justify-left items-center order-3 lg:order-6">
                <span class="ps-3 lg:ps-0">
                    {{$post->address}}
                </span>
            </div>
        </div>
    @endforeach
</div>
