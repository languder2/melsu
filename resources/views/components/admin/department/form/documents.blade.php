<div class="p-4 bg-white rounded-md mb-4">

    <div class="flex mb-4 gap-x-4 items-center">
        <h4 class="text-center font-semibold text-lg uppercase flex-1">
            Добавить документы
        </h4>
        <div class="w-8 text-center flex-2">
            <a href="{{route('admin:department:document:add')}}"
               class="
                inline-block mt-2
                hover:text-blue-700
                active:text-blue-700
            "
               onClick="return AddLine.addLine(this.href,'AddDocuments');"
            >
                <i class="fas fa-plus"></i>
            </a>
        </div>
    </div>
    <div id="AddDocuments">
        @if(!empty(old('documents')))
            @foreach(old('documents') as $key=>$record) @endforeach
            <x-admin.department.form.document-add-block
                :i="$key"
            />
        @else
            <x-admin.department.form.document-add-block
                :i="now()->timestamp"
            />
        @endif


    </div>

</div>
