<div @class([" text-center",$record->show?'text-green-700':'text-red-700'])>
    {{$record->id}}
</div>


<div>
    {{$record->spec_code}}
</div>

<div>
    {{$record->level->getName() ?? null}}
</div>

<div class="md:col-span-2">
    {!! $record->name !!}
</div>

<div>
    {{$record->code}}
</div>

<div>
    {!! $record->department->name ?? null !!}
</div>

<div>
    @foreach($record->profiles->where('show',true) as $profile)
        <p>
            {{ $profile->form->getName() }}
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
        <div class="flex-none w-14">
            <a
                href="{{route('admin:speciality:edit',$record->id)}}"
                class="
                                    py-2 px-4 rounded-md
                                    bg-green-950
                                    hover:bg-green-700
                                    active:bg-gray-700
                                "
            >
                <i class="far fa-edit w-4 h-4"></i>
            </a>
        </div>
    </div>
</div>
<hr class="md:col-span-9 last:hidden">
