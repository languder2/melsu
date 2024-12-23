<div data-ident="work-line" data-ordinal="{{$i}}">
    <x-form.input
        id="works_{{$i}}_employment"
        type="date"
        name="works[{{$i}}][employment]"
        label="Дата трудоустройства"
        value="{{old('works.'.$i.'.employment')??@$work->employment}}"
    />
</div>

<div>
    <x-form.input
        id="work_{{$i}}_dismissal"
        type="date"
        name="works[{{$i}}][dismissal]"
        label="Дата увольнения"
        value="{{old('works.'.$i.'.dismissal')??@$work->dismissal}}"
    />
</div>

<div>
    <x-form.input
        id="work_{{$i}}_post"
        name="works[{{$i}}][post]"
        label="Должность"
        value="{{old('works.'.$i.'.post')??@$work->post}}"
    />
</div>
