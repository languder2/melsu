<div class="flex">

    <div class="flex-1">
        <x-form.input
            id="documents_{{$i}}_file"
            type="file"
            name="documents[{{$i}}][file]"
            value="{{old('documents.'.$i.'.file')}}"
            class="pt-[0.1rem]"
        />
    </div>

    <div class="flex-1">
        <x-form.input
            id="documents_{{$i}}_name"
            label="Наименование"
            name="documents[{{$i}}][name]"
            value="{{old('documents.'.$i.'.name')}}"
        />
    </div>

    <div class="min-w-36">
        <x-form.input
            id="documents_{{$i}}_sort"
            type="numeric"
            name="documents[{{$i}}][sort]"
            label="Sort"
            value="{{old('documents.'.$i.'.sort')??@$current->sort}}"
        />
    </div>

</div>
