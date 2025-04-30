<div class="flex gap-4">

    @if($staff->avatar->name === 'avatar')
        <div class="flex items-center bg-neutral-150 w-16 h-16 justify-center rounded-md">
            <svg height="32" viewBox="0 0 128 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M26.6455 90.9125C16.8993 96.9333 -8.6546 109.227 6.90945 124.611C14.5124 132.126 22.9801 137.5 33.626 137.5H94.374C105.02 137.5 113.488 132.126 121.091 124.611C136.655 109.227 111.101 96.9333 101.354 90.9125C78.4998 76.7939 49.5002 76.7939 26.6455 90.9125Z" stroke="#C10F1A" stroke-width="4"/>
                <path d="M92.1818 31.0882C92.1818 46.8771 79.5644 59.6765 64 59.6765C48.4356 59.6765 35.8182 46.8771 35.8182 31.0882C35.8182 15.2994 48.4356 2.5 64 2.5C79.5644 2.5 92.1818 15.2994 92.1818 31.0882Z" stroke="#C10F1A" stroke-width="4"/>
            </svg>
        </div>
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
                {!! $full_post && $staff->post_alt ? $staff->post_alt : $staff->post !!}
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
