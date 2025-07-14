<form method="get" class="flex gap-4 mb-4 bg-white p-4 items-center">
    @csrf
    <div class="flex-1" >
        <input
            type="text"
            name="search"
            placeholder="Поиск по коду или названию"
            class="
                    w-full
                    outline-0
                    p-2
                    border-b
                "
            value="{{ $filters['search'] ?? null }}"
        >
    </div>

    <select name="level" class="outline-0 border-b p-2">
        <option value="">Все</option>
        @foreach(\App\Enums\EducationLevel::getListAlt() as $level=>$item)
            <option
                value="{{ $level }}"
                @selected(array_key_exists('level',$filters) && $filters['level'] === $level)
            >
                {{ $item }}
            </option>
        @endforeach
    </select>

    <select name="show" class="outline-0 border-b p-2">
        <option value="">Все</option>
        <option
            value="show"
            @selected(array_key_exists('show',$filters) && $filters['show'] === 'show')
        >
            Показываются
        </option>
        <option
            value="hide"
            @selected(array_key_exists('show',$filters) && $filters['show'] === 'hide')
        >
            Скрыты
        </option>
    </select>

    <select name="is_recruitment" class="outline-0 border-b p-2">
        <option value="">Все</option>
        <option
            value="true"
            @selected(array_key_exists('is_recruitment',$filters) && $filters['is_recruitment'] === 'true')
        >
            Ведется набор
        </option>
        <option
            value="false"
            @selected(array_key_exists('is_recruitment',$filters) && $filters['is_recruitment'] === 'false')
        >
            Нет набора
        </option>
    </select>

    <div class="" >
        <input
            type="submit"
            name="submit"
            value="Показать"
            class="
                    bg-blue-800 px-4 py-2 text-white rounded-md
                    cursor-pointer
                    hover:bg-blue-700
                    active:bg-neutral-600
                "
        >
    </div>

    <div class="" >
        <a href="{{ url('education-programs') }}"
           class="
                    inline-block
                    bg-red-800 px-4 py-2 text-white rounded-md
                    cursor-pointer
                    hover:bg-red-700
                    active:bg-neutral-600
                "
        >
            Сбросить
        </a>

    </div>
</form>
<table>
    <tr class="text-center sticky top-0" >
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Код
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Спецциальнось
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            <p>
                Форма
            </p>
            <p>
                Уровень
            </p>
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Предметы
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Практики
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Описание
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Планы
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Программы
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Графики
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Программы практик
        </td>
        <td class="p-4 {{ auth()->check() ? 'bg-blue' : 'bg-red' }} text-white content-center">
            Методологические
        </td>
    </tr>
    @foreach($list as $speciality)
        @foreach($speciality->public_profiles as $profile)
            <tr @class([ $loop->index % 2 ? 'bg-white' : 'bg-white/50', 'text-center' ])>
                <td class="p-4 border-b" itemprop="eduCode">
                    {!! $speciality->spec_code !!}
                </td>
                <td class="p-4 border-b" itemprop="eduName">
                    <p>
                        {!! $speciality->name !!}
                    </p>
                    <p>
                        {!! $speciality->name_profile !!}
                    </p>
                </td>
                <td class="p-4 border-b" itemprop="eduLevel">
                    <p>
                        {!! $speciality->level->getAltName() !!}
                    </p>
                    <p>
                        {!! $profile->form->getName() !!}
                    </p>
                </td>
                <td class="p-4 border-b" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="eduPred"
                    />
                </td>
                <td class="p-4 border-b" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="eduPrac"
                    />
                </td>
                <td class="p-4 border-b" itemprop="opMain" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="opMain"
                    />
                </td>
                <td class="p-4 border-b" itemprop="educationPlan" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="educationPlan"
                    />
                </td>
                <td class="p-4 border-b" itemprop="educationRpd" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="educationRpd"
                    />
                </td>
                <td class="p-4 border-b" itemprop="educationShedule" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="educationShedule"
                    />
                </td>
                <td class="p-4 border-b" itemprop="eduPr" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="eduPr"
                    />
                </td>
                <td class="p-4 border-b" itemprop="methodology" valign="top">
                    <x-info.education.document-list
                        :profileId="$profile->id"
                        code="methodology"
                    />
                </td>
            </tr>
        @endforeach
    @endforeach
</table>
