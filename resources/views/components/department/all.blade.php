@if($departments->count())
    @foreach($departments as $department)
        @dump($department)
    @endforeach
@endif

@dump($departments??"-")
