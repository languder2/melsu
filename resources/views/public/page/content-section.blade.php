<div class="about-otdel mb-4 last:mb-0">
    @if($section->show_title)
        <h2 class="font-bold text-xl my-4 uppercase">
            {{$section->title}}
        </h2>
    @endif
    <div class="bg-white p-6">
        {!! $section->content !!}
    </div>
</div>
