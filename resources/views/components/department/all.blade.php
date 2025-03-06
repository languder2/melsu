<div class="parent">
    <x-department.filter/>
    @if($departments->count())
        @foreach($departments as $department)
            <x-department.item
                :department="$department"
            />
        @endforeach
    @endif
</div>
