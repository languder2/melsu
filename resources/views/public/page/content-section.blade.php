<div class="about-otdel mb-4 last:mb-0">
    @if($section->show_title)
{{--        "font-bold text-xl my-4 uppercase"--}}
        <h2 class="font-semibold py-6 text-xl lowercase first-letter:uppercase">
            {{$section->title}}
        </h2>
    @endif
    <div class="bg-white p-6">
        {!! $section->content !!}
    </div>
</div>
