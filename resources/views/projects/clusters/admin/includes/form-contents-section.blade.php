
<div
    id="{{ $menuItem['tab'] }}"
    @class([
        $menuItem['tabs'],
        (old('side_menu') === $menuItem['tab'])?'':'hidden'
    ])
>
    <div class="bg-white p-4 flex gap-4 mb-4">
        <div class="flex-1 text-lg font-semibold">
            Контент
        </div>
    </div>

    @component('contents.admin.includes.fixed-block',[
        'content'   => $current->relevance()
    ])@endcomponent

    @component('contents.admin.includes.fixed-block',[
        'content'   => $current->goals()
    ])@endcomponent

    @component('contents.admin.includes.fixed-block',[
        'content'   => $current->structure()
    ])@endcomponent

    @component('contents.admin.includes.fixed-block',[
        'content'   => $current->suggestions()
    ])@endcomponent

</div>
