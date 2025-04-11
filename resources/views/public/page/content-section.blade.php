<div class="about-otdel mb-4 last:mb-0">
    @if($section->show_title)
        <h2 class="font-semibold py-6 text-xl">
            {{$section->title}}
        </h2>
    @endif
    <div class="bg-white p-6">
        {!! $section->content !!}
    </div>
</div>
