@if($show)
    <div class="box-heading">
        <h2 class="font-bold text-2xl lg:mb-3">Направления подготовки</h2>
    </div>
@endif
<section class="card-section container custom p-2.5 xl:p-0">

    <x-specialities.filter/>
    <div class="parent grid grid-cols-1 lg:grid-cols-[1fr_1fr] xl:grid-cols-[1fr_1fr_1fr] gap-3">
        @foreach($specialities as $speciality)
            @foreach($speciality->publicProfiles as $profile)
                @foreach($profile->places??[] as $place)

                    <div class="box-searching card-nap position-aware checked-box hidden group">
                        <svg width="285" height="312" viewBox="0 0 285 312" fill="none"
                             xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.4"
                                  d="M142.505 311.82C127.453 311.82 113.252 305.949 102.517 295.287C99.6841 292.474 99.6724 287.9 102.492 285.073C105.31 282.244 109.893 282.234 112.725 285.047C120.729 292.997 131.305 297.374 142.504 297.374C165.818 297.374 184.785 278.442 184.785 255.171V246.101L142.503 221.734L124.306 232.221C120.846 234.214 116.419 233.032 114.421 229.577C112.423 226.122 113.609 221.704 117.069 219.71L128.031 213.392L100.224 197.368V218.17C100.224 222.159 96.9841 225.393 92.9878 225.393C88.9915 225.393 85.7515 222.159 85.7515 218.17V189.027L43.4714 164.662L35.601 169.196C25.8681 174.806 18.8923 183.912 15.9598 194.838C13.0263 205.764 14.5062 217.131 20.1261 226.846C23.9776 233.506 29.5885 238.979 36.3518 242.67C39.8578 244.583 41.1458 248.972 39.2291 252.473C37.3115 255.972 32.9154 257.261 29.4085 255.344C20.316 250.381 12.7731 243.024 7.59367 234.07C0.0407517 221.013 -1.95195 205.752 1.98099 191.098C5.91484 176.445 15.285 164.223 28.3656 156.686L28.9996 156.32L28.3647 155.954C1.27817 140.344 -8.04494 105.658 7.56835 78.6134C7.57649 78.5981 7.58553 78.5836 7.59367 78.5692C23.2413 51.5182 58.0164 42.2184 85.1183 57.834L85.7524 58.1997V57.4693C85.7524 26.2334 111.212 0.820312 142.505 0.820312C156.549 0.820312 170.05 6.03006 180.521 15.488C183.484 18.1651 183.713 22.7319 181.031 25.6907C178.35 28.6486 173.773 28.8762 170.811 26.1991C163.006 19.1492 152.953 15.2667 142.505 15.2667C119.191 15.2667 100.225 34.1997 100.225 57.4702V66.5407L142.505 90.9064L165.321 77.7584C168.782 75.7639 173.209 76.9476 175.206 80.4021C177.204 83.8566 176.018 88.2745 172.558 90.269L156.978 99.2483L184.786 115.274V106.895C184.786 102.906 188.026 99.6718 192.022 99.6718C196.019 99.6718 199.259 102.906 199.259 106.895V123.615L241.538 147.981L249.408 143.444C259.141 137.837 266.116 128.73 269.049 117.805C271.981 106.88 270.501 95.5112 264.882 85.796C260.973 79.036 255.26 73.5093 248.361 69.8128C244.839 67.9258 243.518 63.5476 245.408 60.0326C247.297 56.5158 251.685 55.1976 255.206 57.0837C264.48 62.0524 272.16 69.4833 277.417 78.5737C284.969 91.6297 286.961 106.89 283.028 121.544C279.094 136.197 269.724 148.419 256.645 155.957L256.011 156.322L256.645 156.687C269.725 164.227 279.095 176.447 283.028 191.101C286.951 205.715 284.979 220.932 277.477 233.966C277.457 234.002 277.437 234.038 277.417 234.073C261.769 261.123 226.992 270.427 199.892 254.807L199.258 254.443V255.173C199.259 286.408 173.8 311.82 142.505 311.82ZM199.259 237.761L207.129 242.295C227.289 253.915 253.151 247.023 264.832 226.938C264.849 226.907 264.867 226.876 264.884 226.846C270.503 217.13 271.983 205.763 269.05 194.838C266.117 183.912 259.142 174.805 249.409 169.196L241.539 164.661L199.26 189.027L199.259 237.761ZM156.977 213.393L184.786 229.42V197.368L156.977 213.393ZM100.225 180.686L142.504 205.052L184.786 180.686V131.954L142.505 107.588L100.225 131.954V180.686ZM57.945 156.321L85.7524 172.346V140.295L57.945 156.321ZM199.259 140.296V172.345L227.065 156.321L199.259 140.296ZM20.1523 85.75C20.1433 85.7653 20.1351 85.7798 20.1261 85.7951C8.47017 105.947 15.4125 131.809 35.601 143.444L43.4723 147.98L85.7524 123.614V74.8817L77.882 70.3465C57.7071 58.7171 31.8209 65.6315 20.1523 85.75ZM100.225 83.2227V115.274L128.032 99.2483L100.225 83.2227ZM76.7585 280.733C63.8191 280.733 53.292 270.225 53.292 257.309C53.292 244.393 63.8191 233.885 76.7585 233.885C89.698 233.885 100.225 244.393 100.225 257.309C100.225 270.225 89.698 280.733 76.7585 280.733ZM76.7585 248.331C71.7989 248.331 67.7647 252.359 67.7647 257.309C67.7647 262.258 71.7989 266.286 76.7585 266.286C81.7172 266.286 85.7524 262.258 85.7524 257.309C85.7524 252.359 81.7172 248.331 76.7585 248.331ZM206.5 80.8183C193.56 80.8183 183.033 70.3103 183.033 57.3943C183.033 44.4783 193.56 33.9704 206.5 33.9704C219.44 33.9704 229.968 44.4783 229.968 57.3943C229.968 70.3103 219.44 80.8183 206.5 80.8183ZM206.5 48.4159C201.541 48.4159 197.506 52.4437 197.506 57.3934C197.506 62.3431 201.54 66.371 206.5 66.371C211.459 66.371 215.495 62.3431 215.495 57.3934C215.495 52.4437 211.459 48.4159 206.5 48.4159Z"
                                  fill="#C10F1A"/>
                        </svg>
                        <a
                            href="{{route('public:education:speciality',$speciality->code)}}"
                            class="p-4"
                        >
                            <div>
                                <input
                                    type="checkbox"

                                    data-form="{{$profile->form}}"
                                    data-type="{{$place->type}}"
                                    data-level="{{$speciality->level}}"

                                    class="hidden education-profile"

                                    value="{{$speciality->spec_code}} {{$speciality->name}}"

                                    @if($profile->form->value === 'full-time' && $place->type === 'budget' )
                                        checked
                                    @endif
                                >

                                <p class="sku uppercase font-medium mb-3">
                                    {{$speciality->faculty->name ?? ''}}
                                </p>

                                <h2 class="text-xl font-[600] name mb-6">
                                    {{$speciality->spec_code}}
                                    -
                                    {{$speciality->name}}
                                </h2>
                            </div>
                            <div class="grid grid-cols-1 lg:grid-cols-[1fr_1fr] gap-3 group-hover:text-white">
                                @if($place->type !== 'budget' && $profile->price)
                                    <div class="flex flex-col">
                                        <span class="font-[400]">
                                                {{$profile->price/1000}}
                                                тыс
                                        </span>
                                        <span class="font-[400] text-sm text-neutral-700 group-hover:text-white">Стоимость, ₽</span>
                                    </div>
                                @endif

                                @if($profile->budget_scores)
                                    <div class="flex flex-col">
                                        <span class="font-[400]">
                                            {{ $profile->budget_scores }}
                                        </span>
                                        <span class="font- text-sm text-neutral-700 group-hover:text-white">Проходной балл</span>
                                    </div>
                                @endif

                                @if($place->count)
                                    <div class="flex flex-col">
                                        <span class="font-[400] text-sm">
                                            {{ $place->count }}
                                        </span>
                                        <span class="font-[400] text-sm text-neutral-700 group-hover:text-white">
                                            @if($place->type === 'budget')
                                                Бюджетных мест
                                            @else
                                                Контрактны мест
                                            @endif
                                        </span>
                                    </div>
                                @endif

                                @if($profile->duration)
                                    <div class="flex flex-col">
                                            <span class="font-[400] text-sm">
                                                {{$profile->durationYear('OOO')}}
                                                {{$profile->durationMonth('OOO')}}
                                        </span>
                                        <span class="font-[400] text-sm text-neutral-700 group-hover:text-white ">Срок обучения</span>
                                    </div>
                            </div>
                            @endif
                            <span class="aware-bg"></span>
                        </a>
                    </div>
                @endforeach
            @endforeach
        @endforeach


    </div>
    <div
        class="
            no-search
            border-2 border-baseRed
            px-10 py-4 bg-white w-full my-3
            text-center font-semibold text-lg
            hidden
        "
    >
        Направления подготовки по заданным параметрам не найдены
    </div>

    @if($is_short)
        <div class="more-btns">
            <div class="btn-more-box flex items-center active justify-end">
                <a href="{{route('public:education:specialities:all')}}" class="btn-more">
                    Все программы
                </a>
                <a href="{{route('public:education:specialities:all')}}" class="btn-more">
                    <i class="bi bi-arrow-right-circle-fill"></i>
                </a>
            </div>
        </div>
    @endif
</section>
