@extends("layouts.main")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('content')

    <section class="flex flex-col gap-4 mx-10 my-8">
        <div class="group">
            <label class="cursor-pointer p-4 text-white bg-red-900 block hover:bg-red-700 active:bg-gray-700 group-has-checked:bg-green-900 group-has-checked:hover:bg-green-700 duration-500 transition-all">
                <input type="checkbox" class="hidden" checked>
                Test 1
            </label>

            <div class=" overflow-hidden max-h-0 group-has-checked:max-h-50 duration-500 transition-all">
                <div class="p-4 mt-4 bg-indigo-100">
                    123312
                </div>
            </div>
        </div>

        <div class="group">
            <label class="cursor-pointer p-4 text-white bg-red-900 block hover:bg-red-700 active:bg-gray-700 group-has-checked:bg-green-900 group-has-checked:hover:bg-green-700 duration-500 transition-all">
                <input type="checkbox" class="hidden">
                Test 2
            </label>

            <div class=" overflow-hidden max-h-0 group-has-checked:max-h-20 duration-500 transition-all">
                <div class="p-4 mt-4 bg-indigo-100">
                    123312
                </div>
            </div>
        </div>

        <div class="group">
            <label class="cursor-pointer p-4 text-white bg-red-900 block hover:bg-red-700 active:bg-gray-700 group-has-checked:bg-green-900 group-has-checked:hover:bg-green-700 duration-500 transition-all">
                <input type="checkbox" class="hidden">
                Test 3
            </label>

            <div class=" overflow-hidden max-h-0 group-has-checked:max-h-20 duration-500 transition-all">
                <div class="p-4 mt-4 bg-indigo-100">
                    123312
                </div>
            </div>
        </div>

    </section>


@endsection
