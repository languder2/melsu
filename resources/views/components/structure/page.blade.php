@foreach($list as $group)

    @switch($group->type)
        @case('rector')
            <x-structure.section-rector :group="$group"/>
            @break
        @case('departments')
            <x-structure.section-departments :group="$group"/>
            @break
        @case('office')
            <x-structure.section-office :group="$group"/>
            @break
        @case('sections')
            <x-structure.section-sections :group="$group"/>
            @break
        @case('centers')
            <x-structure.section-centers :group="$group"/>
            @break
        @case('university')
            <x-structure.section-university :group="$group"/>
            @break
        @case('labs')
            <x-structure.section-labs :group="$group"/>
            @break
    @endswitch

@endforeach
