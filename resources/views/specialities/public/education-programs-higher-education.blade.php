@extends("layouts.page")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')
    {{--    {!!Breadcrumbs::view("vendor.breadcrumbs.base",'division',$division)!!}--}}
@endsection

@section('aside')
    {{--    {!!view('public.menu.aside-tree',['menu' => $menu ?? null ])!!}--}}
    menu
@endsection

@section('content')

    <div class="grid gap-2 grid-cols-[]">
        <div class="font-semibold">
            Код
        </div>
        <div class="font-semibold">
            Наименование
        </div>
        <div class="font-semibold">
            Уровень
        </div>
        <div class="font-semibold">
            Форма
        </div>
        <div class="font-semibold">
            Учебный план
        </div>

    </div>

    <div class="overflow-x-scroll">

        <table class="w-full" border="1px">
            <thead>
            <tr>
                <th>
                    Код
                </th>
                <th>
                    Наименование
                </th>
                <th>
                    Уровень
                </th>
                <th>
                    Форма
                </th>
                <th>
                    Учебный план
                </th>
            </tr>
            </thead>
            <tbody>
            @foreach($specialities as $speciality)
                @foreach($speciality->publicProfiles as $profile)
                    <tr>
                        <td class="p-1">
                            {!! $speciality->spec_code !!}
                        </td>
                        <td class="p-1">
                            {!! $speciality->name !!}
                        </td>
                        <td class="text-center p-1">
                            {!! $speciality->level->getName() !!}
                        </td>
                        <td class="text-center p-1">
                            {!! $profile->form->getName() !!}
                        </td>
                        <td class="p-1">
                            {!! $speciality->spec_code !!}
                        </td>
                    </tr>
                @endforeach
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
