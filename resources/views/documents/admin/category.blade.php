<h3 class="text-xl font-semibold mt-2 -mb-2 flex gap-4 justify-between px-3">
    {!! $name !!}
    @if($category)
        <a
            href="{{ route('documents:admin:form') }}?category_id={{$category->id ?? null}}"
            class="
                rounded-md
                text-white
                bg-blue-950 hover:bg-blue-700 active:bg-gray-700
                flex h-8 w-8 items-center justify-center
            "
        >
            <i class="fas fa-plus w-4 py-2"></i>
        </a>
    @endif
</h3>
<div class="grid gap-4 grid-cols-[auto_auto_auto_1fr_1fr_auto] items-center p-4 bg-white shadow">
    <div class="font-semibold">
        <a
            href="{{ route('documents:admin:list',['id', ($field === 'id' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
            class="@if($field === 'id') text-green-700 @endif hover:text-red flex gap-2 items-center"
        >
                <span class="underline">
                    ID
                </span>

            @if($field === 'id')
                @if($direction === 'desc')
                    <i class="fas fa-sort-amount-down"></i>
                @else
                    <i class="fas fa-sort-amount-down-alt"></i>
                @endif
            @endif
        </a>
    </div>
    <div class="font-semibold">
    </div>
    <div class="font-semibold">
        <a
            href="{{ route('documents:admin:list',['sort', ($field === 'sort' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
            class="@if($field === 'sort') text-green-700 @endif hover:text-red flex gap-2 items-center"
        >
                <span class="underline">
                    Порядок вывода
                </span>

            @if($field === 'sort')
                @if($direction === 'desc')
                    <i class="fas fa-sort-amount-down"></i>
                @else
                    <i class="fas fa-sort-amount-down-alt"></i>
                @endif
            @endif
        </a>
    </div>
    <div class="font-semibold">
        <a
            href="{{ route('documents:admin:list',['title', ($field === 'title' && $direction === 'asc' ) ? 'desc' : 'asc']) }}"
            class="@if($field === 'title') text-green-700 @endif hover:text-red flex gap-2 items-center"
        >
                <span class="underline">
                    Название
                </span>

            @if($field === 'title')
                @if($direction === 'desc')
                    <i class="fas fa-sort-amount-down"></i>
                @else
                    <i class="fas fa-sort-amount-down-alt"></i>
                @endif
            @endif
        </a>
    </div>
    <div class="font-semibold">
        Ссылка на файл
    </div>
    <div class="font-semibold">
        Del
    </div>
    @each('documents.admin.item',$documents,'item')
</div>
