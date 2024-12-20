<x-head.tinymce-config />
<form
    action="{{route('admin:staff:save')}}"
    method="POST"
    enctype="multipart/form-data"
    class="
        p-4 bg-white rounded-md
        max-w-[1200px]
        mx-auto
    "
>
    @csrf

    <h3 class="pb-2 font-semibold text  -xl uppercase text-center">
        @if(isset($current->id))
            Внести изменения в карточку сотрудника
        @else
            Добавить карточку сотрудника
        @endif
    </h3>

    <hr>

    <x-form.errors />

    <x-form.input type="hidden" name="id" value="{{$current->id??null}}"/>

    <x-form.input
        id="photo"
        type="file"
        name="photo"
        value="{{old('photo')}}"
    />

    <x-form.input
        id="lastname"
        name="lastname"
        label="Фамилия"
        value="{{old('lastname')??@$current->lastname}}"
        required
    />

    <x-form.input
        id="firstname"
        name="firstname"
        label="Имя"
        value="{{old('firstname')??@$current->firstname}}"
        required
    />

    <x-form.input
        id="middle_name"
        name="middle_name"
        label="Отчество"
        value="{{old('middle_name')??@$current->middle_name}}"
    />

    <x-form.input
        id="post"
        name="post"
        label="Должность"
        value="{{old('post')??@$current->post}}"
        required
    />

    <x-form.input
        id="birthday"
        type="date"
        name="birthday"
        label="Дата рождения"
        value="{{old('birthday')??@$current->birthday}}"
    />

    <x-form.input
        id="birthplace"
        name="birthplace"
        label="Место рождения"
        value="{{old('birthplace')??@$current->birthplace}}"
    />

    <x-form.input
        id="residence"
        name="residence"
        label="Место проживания"
        value="{{old('residence')??@$current->residence}}"
    />

    <x-form.input
        id="education"
        name="education"
        label="Образование"
        value="{{old('education')??@$current->education}}"
    />

    <x-form.input
        id="awards"
        name="awards"
        label="Награды, поощрение"
        value="{{old('awards')??@$current->awards}}"
    />

    <x-form.input
        id="education"
        name="education"
        label="Образование"
        value="{{old('education')??@$current->education}}"
    />

    <x-form.input
        id="affiliation"
        name="affiliation"
        label="Партийная принадлежность"
        value="{{old('affiliation')??@$current->affiliation}}"
    />

    <x-form.input
        id="family_status"
        name="family_status"
        label="Семейное положение"
        value="{{old('family_status')??@$current->family_status}}"
    />

    <x-form.input
        id="title"
        name="title"
        label="Ученая степень, звание"
        value="{{old('title')??@$current->title}}"
    />

    <x-form.input
        id="title_alt"
        name="title_alt"
        label="Ученая степень, звание (alt)"
        value="{{old('title_alt')??@$current->title_alt}}"
    />

    <x-form.input
        id="reception_time"
        name="reception_time"
        label="Прием по личным вопросам"
        value="{{old('reception_time')??@$current->reception_time}}"
    />

    <x-form.input
        id="phones"
        name="phones"
        label="Телефоны (через ,)"
        value="{{old('phones')??@$current->phones}}"
    />

    <x-form.input
        id="emails"
        name="emails"
        label="Emails (через ,)"
        value="{{old('emails')??@$current->emails}}"
    />

    <x-form.input
        id="address"
        name="address"
        label="Образование"
        value="{{old('address')??@$current->address}}"
    />

    <x-form.input
        id="alias"
        name="alias"
        label="alias (для использования в ссылке, или не заполнено или уникально)"
        value="{{old('alias')??@$current->alias}}"
    />

    <x-form.submit
        class="uppercase"
        value="сохранить"
    />

</form>

@dump($current)
