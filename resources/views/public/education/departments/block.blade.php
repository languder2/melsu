@php $case = \App\Enums\CardBG::getRandom() @endphp

<a href="{{$department->link}}"
    class="
        group
        {{$case}} p-6 flex flex-col
        text-stone-50 rounded-lg

        hover:-mt-1 hover:mb-1 hover:text-white
        hover:shadow-md hover:shadow-black/5
    "
>



    <div class="h-full"
        @if($department->ico)
            style="background: url({{$department->ico->image}}) bottom right no-repeat; background-size: contain;"
        @endif
    >
        <h3 class="font-semibold " >
            {!! $department->name !!}
        </h3>

        <div class="flex-grow h-4"></div>

        @if($department->chief)
            <p class="my-2 flex gap-4 items-center">
                <i class="far fa-user text-stone-50 opacity-70"></i>
                {{ $department->chief->card->full_name }}
            </p>
        @endif

        @if($department->phones->count())
            <div class="my-2 text-stone-50 stroke-stone-50">
                @foreach($department->phones as $contact)
                    @component('public.contacts.contact',[
                        'contact'   => $contact,
                        'color'     => 'stroke-white'
                    ]) @endcomponent

                @endforeach
            </div>
        @endif

        @if($department->emails->count())
            @foreach($department->emails as $contact)
                @component('public.contacts.contact',[
                    'contact'   => $contact,
                    'color'     => 'stroke-white'
                ]) @endcomponent

            @endforeach
        @endif
    </div>
</a>
