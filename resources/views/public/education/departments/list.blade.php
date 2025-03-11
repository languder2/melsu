@extends("layouts.main")

@section('title', 'ФГБОУ ВО "МелГУ": Факультеты')

@section('breadcrumbs')
    {{Breadcrumbs::view("vendor.breadcrumbs.base",'faculties',null)}}
@endsection

@section('content')

    @include("public.education.tabs.list",['active' => 'branches'])

    @include("public.education.departments.search")

    @if(!isset($without_container))
        <section id="DepartmentsList" class="container pb-20">
    @endif
            <div class="grid gap-4 grid-cols-[100px_1fr] gap-x-4 gap-y-20">
                @foreach($list as $letter=>$group)
                    <h3 class="font-semibold text-4xl">
                        {{$letter}}
                    </h3>
                    <div class="grid gap-4 grid-cols-1 md:grid-cols-2 items-center">
                        @foreach($group as $item)
                            <a
                                href="{{$item->link}}"
                                class="grid grid-cols-[80px_1fr] gap-4 items-center group"
                            >
                                <div class="text-center">
                            <span
                                class="
                                    rounded-lg bg-gray-200 inline-block py-2 px-4
                                    group-hover:bg-base-red group-hover:text-white
                                    font-semibold
                                "
                            >
                                {{$item->parent->acronym ?? null}}
                            </span>
                                </div>

                                <div class="font-semibold group-hover:text-base-red">
                                    {{$item->alt_name ?? null}}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endforeach
            </div>

            @if(!isset($without_container))
        </section>
    @endif
@endsection


