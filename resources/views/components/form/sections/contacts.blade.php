<div
    id="tab_contacts"
    @class([
        "form_box",
        (old('side_menu') === 'tab_contacts')?'':'hidden'
    ])
>
    <div class="mb-4 bg-stone-50 flex gap-4 p-4 items-center">
        <div class="font-semibold text-lg flex-1">
            Контакты
        </div>
        <x-admin.contact.list-of-types-for-add />
    </div>

    <x-admin.contact.show-list
        :list="old('_token') ? old('contacts') : $current->contacts"
    />

    <div class="mb-4 bg-stone-50 flex gap-4 p-4 justify-end">
        <x-admin.contact.list-of-types-for-add />
    </div>

</div>

