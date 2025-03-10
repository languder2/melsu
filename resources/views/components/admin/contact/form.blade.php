<div class="contact grid grid-cols-[auto_1fr] gap-3 my-4 bg-stone-50 p-4">

    <div class="text-xl py-2 px-4 bg-gray-100 content-center">
        {!! $current->type->getIco() !!}
    </div>

    <div>
        <div class="grid gap-3 grid-cols-[1fr_auto]">
            <input type="hidden" name="contacts[{{$current->id}}][id]" value="{{$current->id}}">
            <input type="hidden" name="contacts[{{$current->id}}][type]" value="{{$current->type}}">

            <x-form.input.with-label
                id="contact_{{$current->id}}_content"
                name="contacts[{{$current->id}}][content]"
                old="contacts.{{$current->id}}.content"
                :value="$current->content"
                :label="$current->type->getName()"
                required
            />
            <div class="pt-3">
                <x-form.button.trash
                    link="{{route('api:contact:delete',[$current->id])}}"
                    block="contact"
                />
            </div>
        </div>

        <div class="grid grid-cols-[1fr_auto] gap-4 items-center mt-3">
            <div>
                <x-form.input.with-label
                    id="contact_{{$current->id}}_sort"
                    name="contacts[{{$current->id}}][sort]"
                    old="contacts.{{$current->id}}.sort"
                    :value="$current->sort"
                    label="Порядок вывода"
                />
            </div>

            <div class="pt-3">
                <x-form.checkbox.base
                    id="form_sections_{{$current->id }}_show"
                    name="contacts[{{$current->id}}][is_show]"
                    text="Опубликовать секцию"
                    class="text-lg"
                    :checked='
                        old("_token")
                        ? old("contacts.{$current->id}.is_show")
                        : $current->is_show ?? null
                    '
                />
            </div>

        </div>

    </div>

</div>
