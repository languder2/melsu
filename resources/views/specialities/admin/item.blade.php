<div @class([" text-center",$record->show?'text-green-700':'text-red-700'])>
    {{$record->id}}
</div>

<div>
    {{$record->level->getName() ?? null}}
</div>

<div class="flex flex-col gap-2">
    @isset($record->faculty)
        <a
            href="{{ $record->faculty->edit }}"
            class="underline text-blue hover:text-red"
            target="_blank"
        >
            {!! $record->faculty->name !!}
        </a>
    @endisset
    @isset($record->department)
        <a
            href="{{ $record->department->edit }}"
            class="underline text-blue hover:text-red"
            target="_blank"
        >
            {!! $record->department->name !!}
        </a>
    @endisset
    @isset($record->relation)
        <a
            href="{!! $record->relation->edit !!}"
            target="_blank"
            class="underline text-blue hover:text-red"
        >
            {!! $record->relation->name !!}
        </a>
    @endisset

</div>

<div>
    {{$record->spec_code}}
</div>

<div class="md:col-span-2 flex flex-col gap-2">

    <p>
        <a href="{{ $record->form }}" class="underline text-blue hover:text-red">
            {!! $record->name !!}
        </a>
    </p>
    <p>
        <a href="{{ $record->form }}" class="underline text-blue hover:text-red">
            {!! $record->name_profile !!}
        </a>
    </p>
</div>

<div>
    <a href="{{ $record->link }}" target="_blank" class="underline text-blue hover:text-red">
        {{ $record->link }}
    </a>
</div>


<div>
    @foreach($record->profiles as $profile)
        <p @class([$profile->show === 1 ? 'text-green-700' : 'text-red-700'])>
            {{ $profile->form->getName() ?? null }}
        </p>
    @endforeach
</div>

<div>
    <div class="flex flex-row-reverse text-white w-full">
        <div class="flex-none w-14">
            <a
                href="{{route('admin:speciality:delete',$record->id)}}"
                class="
                    py-2 px-4 rounded-md
                    bg-red-950
                    hover:bg-red-700
                    active:bg-gray-700
                "
            >
                <i class="fas fa-trash w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
<hr class="md:col-span-9 last:hidden">
