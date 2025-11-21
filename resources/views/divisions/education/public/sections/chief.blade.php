@props([
    'division'      => new \App\Models\Division\Division(),
])

<div class="flex flex-col xl:flex-row gap-5">
    @if($division->chief->card->exists)
        <div class="flex flex-col sm:max-w-[240px]">
            <div class="bg-neutral-200 h-full">
                @if($division->chief->card->avatar->name === 'avatar')
                    <div class="flex items-center h-full w-full justify-center rounded-md">
                        <svg height="150px" viewBox="0 0 128 140" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M26.6455 90.9125C16.8993 96.9333 -8.6546 109.227 6.90945 124.611C14.5124 132.126 22.9801 137.5 33.626 137.5H94.374C105.02 137.5 113.488 132.126 121.091 124.611C136.655 109.227 111.101 96.9333 101.354 90.9125C78.4998 76.7939 49.5002 76.7939 26.6455 90.9125Z" stroke="#C10F1A" stroke-width="4"/>
                            <path d="M92.1818 31.0882C92.1818 46.8771 79.5644 59.6765 64 59.6765C48.4356 59.6765 35.8182 46.8771 35.8182 31.0882C35.8182 15.2994 48.4356 2.5 64 2.5C79.5644 2.5 92.1818 15.2994 92.1818 31.0882Z" stroke="#C10F1A" stroke-width="4"/>
                        </svg>
                    </div>
                @else
                    <img
                        src="{{$division->chief->card->avatar->thumbnail}}"
                        alt="{{$division->chief->card->full_name}}"
                        class="object-cover w-full h-full"
                    />
                @endif

            </div>
            <div class="bg-[#252525] p-5 ">
                <div class="flex flex-col gap-4 items-top">
                    <h3 class="font-bold text-xl text-white">
                        {{ $division->chief->card->full_name }}
                    </h3>
                    <span class="text-white">
                    {{ $division->chief->post }}
                </span>
                </div>
            </div>
        </div>
    @endif
    <div class="bg-white p-5 flex flex-col gap-7">
        <div>
            @component('divisions.education.public.sections.contacts', [
                'contacts'  => $division->contacts,
                'color'     => 'text-black'
            ]) @endcomponent
        </div>
    </div>
</div>
