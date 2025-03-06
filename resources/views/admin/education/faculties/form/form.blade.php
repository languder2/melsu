@extends("layouts.admin")

@section('title', 'ФГБОУ ВО "Мелитопольский государственный университет"')

@section('top-menu')
    {{view('admin.education.menu')}}
@endsection

@section('top-menu')
    231
@endsection

@section('content')

    <x-head.tinymce-config/>
    <form
        action="{{route('admin:education:faculty:save')}}"
        method="POST"
        enctype="multipart/form-data"
    >
        @csrf

        <input type="hidden" name="id" value="{{$current->id ?? null}}">

        <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">
            <div>
                {{view('admin/education/faculties/form/menu')}}
                <x-form.submit
                    class="uppercase"
                    value="сохранить"
                />
            </div>

            <div>
                <x-form.errors
                    setTheme="1"
                />

                {{view('admin/education/faculties/form/section-base',['current'=>$current])}}
                {{view('admin/education/faculties/form/section-staffs',['current'=>$current])}}
                {{view('admin/education/faculties/form/section-documents',['current'=>$current])}}
                {{view('admin/education/faculties/form/section-contents',['current'=>$current])}}

            </div>

        </div>

    </form>
@endsection



