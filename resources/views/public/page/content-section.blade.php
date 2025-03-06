<div class="p-corrector">
    @if($section->show_title)
        <h2 class="font-bold text-xl my-6 uppercase">
            {{$section->title}}
        </h2>
    @endif
    <div class="bg-white p-6 mb-5">
        {!! $section->content !!}
    </div>
</div>
