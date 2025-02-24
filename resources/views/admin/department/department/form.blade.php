<x-head.tinymce-config/>
<form
    action="{{route('admin:department:save')}}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf

    <input type="hidden" name="id" value="{{$current->id??null}}">



    <div class="grid grid-cols-[400px_minmax(400px,1200px)] mx-auto gap-4">
        <div>
            {{view('admin/department/department/form/menu')}}
            <x-form.submit
                class="uppercase"
                value="сохранить"
            />
        </div>

        <div>
            <x-form.errors
                setTheme="1"
            />

            @include('admin/department/department/form/section-base')
            {{view('admin/department/department/form/section-staffs',['current'=>$current])}}
            {{view('admin/department/department/form/section-documents',['current'=>$current])}}
            {{view('admin/department/department/form/section-contents',['current'=>$current])}}

        </div>

    </div>

</form>

{{--@if(old('_token'))--}}
{{--    @dump(old())--}}
{{--@endif--}}
