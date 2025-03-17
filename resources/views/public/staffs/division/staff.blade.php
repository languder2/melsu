<div class="flex gap-4">

    @if($staff->avatar->name === 'avatar')
        <svg height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
            <rect width="64" height="64" rx="12" fill="#EEEEEE"/>
            <path d="M24.7701 36.1825C22.8837 37.3867 17.9378 39.8454 20.9502 42.9221C22.4217 44.4251 24.0607 45.5 26.1212 45.5H37.8788C39.9393 45.5 41.5783 44.4251 43.0498 42.9221C46.0622 39.8454 41.1163 37.3867 39.2299 36.1825C34.8064 33.3588 29.1936 33.3588 24.7701 36.1825Z" stroke="#C10F1A" stroke-width="2"/>
            <path d="M37.4545 24.2176C37.4545 27.3754 35.0125 29.9353 32 29.9353C28.9875 29.9353 26.5455 27.3754 26.5455 24.2176C26.5455 21.0599 28.9875 18.5 32 18.5C35.0125 18.5 37.4545 21.0599 37.4545 24.2176Z" stroke="#C10F1A" stroke-width="2"/>
        </svg>
    @else
        <img
            src="{{$staff->avatar->thumbnail}}"
            alt="{{$staff->avatar->name}}"
            class="h-16"
        />
    @endif


    <div class="flex flex-col flex-1 gap-1">
        <h5 class="font-semibold">
            {{$staff->full_name}}
        </h5>

        @isset($staff->post)
            <p>
                {!! $staff->post !!}
            </p>
        @endisset
        @isset($staff->posts)
            @foreach($staff->posts as $post)
                <p>
                    {!! $post !!}
                </p>
            @endforeach
        @endisset
    </div>
</div>
