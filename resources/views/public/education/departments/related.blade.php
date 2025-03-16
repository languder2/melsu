<div class="wrapper mb-4">
    @if($division->departments->count())
        <h4 class="font-semibold text-lg mb-2">
            Кафедры
        </h4>

        <div class="grid grid-cols-1 xl:grid-cols-2 2xl:grid-cols-3 gap-3 ">
            @each("public.education.departments.block",$division->departments,'department')
        </div>
    @endif

    @if($division->FacultyLabs->count())
        <h4 class="font-semibold text-lg mb-2 mt-6">
            Лаборатории
        </h4>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @each("public.education.departments.block",$division->FacultyLabs,'department')
        </div>
    @endif

    @if($division->labs->count())
        <h4 class="font-semibold text-lg mb-2 mt-6">
            Лаборатории
        </h4>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
            @each("public.education.departments.block",$division->labs,'department')
        </div>
@endif
