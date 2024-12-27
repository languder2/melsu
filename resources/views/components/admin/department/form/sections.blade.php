<div class="p-4 bg-white rounded-md mb-4">

    <h3 class="pb-2 font-semibold text  -xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения в карточку отдела
        @else
            Добавить карточки отдела
        @endif
    </h3>


    <div id="content-sections">
        @if(!empty(old('sections')))
            @foreach(old('sections') as $code=>$section)
                <x-admin.department.form.content
                    :i="$code"
                    :current="(object)$section"
                />
            @endforeach
        @elseif(!empty($current->sections) and count($current->sections))
            @foreach($current->sections as $section)
                <x-admin.department.form.content
                    :i="$section->id"
                    :current="(object)$section"
                />
            @endforeach
        @else
            <x-admin.department.form.content
                :i="now()->getTimestamp()"
                :current="[]"
            />
        @endif
    </div>

    <div class="flex">

        <div class="flex-1 pt-4">
            <a href="{{route('admin:department:content:add')}}"
               class="
                    addLine
                    py-2 px-4
                    rounded-md
                    text-white
                    bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                "
               data-ident="department-section"
               data-block="content-sections"
            >
                <i class="fas fa-plus w-4 py-2"></i>
                Добавить секцию
            </a>
        </div>

        <div class="flex-1">
            <x-form.submit
                class="uppercase"
                value="сохранить"
            />
        </div>
    </div>

</div>
