<div class="flex gap-4 justify-between items-center pr-4">
    <h3>
        <a
            href="{{ $category->relation_form  }}"
            class="underline underline-offset-3"
        >
            {{ $category->name_with_parents }}
        </a>
    </h3>
    <div class="flex gap-3">
        <a
            href="{{ $category->relation_document_add }}"
            class="
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                flex h-8 items-center justify-center gap-3 px-4
            "
        >
            <i class="fas fa-plus w-4 py-2"></i>
        </a>
        <span></span>
        <form
            action="{{ $category->relation_delete }}"
            method="POST"
            onsubmit="return confirm('Удалить это подразделение?')"
        >
            @csrf
            @method("DELETE")
            <label
                class="
                    cursor-pointer
                    rounded-md
                    text-white
                    bg-red-950 hover:bg-red-700 active:bg-gray-700
                    flex h-8 items-center justify-center gap-3 px-4
                "
            >
                Удалить категорию
                <input type="submit" class="hidden">
            </label>
        </form>
    </div>
</div>

<div class="grid gap-4 grid-cols-[auto_auto_auto_auto_1fr_auto_auto_auto] items-center p-4 bg-white shadow">
    <div class="font-semibold">
        ID
    </div>
    <div class="font-semibold">
    </div>
    <div class="font-semibold">
        Порядок вывода
    </div>
    <div class="font-semibold">
        Тип
    </div>
    <div class="font-semibold">
        Название
    </div>
    <div class="font-semibold">
        Даты
    </div>
    <div class="font-semibold">
        Ссылка на файл
    </div>
    <div class="font-semibold">
        Del
    </div>

    @each('divisions.documents.item',$category->documents,'item')

</div>

@foreach($category->subs as $category)
    @component('divisions.documents.category',compact('category','field','direction')) @endcomponent
@endforeach
