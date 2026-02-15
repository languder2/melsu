@props([
])
<div class="flex flex-col gap-3">

    <form
        action="{{ route('finance.compilation.upload') }}" method="POST" enctype="multipart/form-data"
        class="flex gap-3 p-3 bg-white shadow"
    >
        @csrf
        @method("PUT")

        <x-form.file
            id="file"
            :label="__('common.Document')"
            name="file"
            :required="true"
            accept=".xls, .xlsx"
            block="flex-1"
        />

        <x-form.input
            name="page"
            type="number"
            :value="old('value', 1)"
            label="Номер страницы"
        />

        <div class="p-3">
            <x-html.submit :text="__('labels.Apply')" class="order-2"/>
        </div>
    </form>

    @if(session()->has('error'))
        <div class="p-3 bg-white rounded-md shadow border-1 border-red-700 border-s-4 ">
            {{ session()->get('error') }}
        </div>
    @endif

</div>
