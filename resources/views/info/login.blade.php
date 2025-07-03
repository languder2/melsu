@extends("layouts.info")

@section('title', 'ФГБОУ ВО "МелГУ"')

@section('breadcrumbs')

@endsection

@section('content-header')

@endsection

@section('content')

    <div class="min-h-full flex items-center justify-center">
        <div class="grid grid-cols-1 md:grid-cols-2 max-w-100 md:max-w-none w-full md:w-auto">
            <div
                class="bg-neutral-200 p-8 w-full md:w-96 md:rounded-l-lg"
            >
                @component('components.info.auth.login')@endcomponent
            </div>
            <div
                class="text-white bg-[image:var(--bg-panel-1)] p-8 w-full md:w-96  md:rounded-r-lg bg-cover"
            >
                <div class="flex flex-col gap-3">
                    <p>

                    </p>
                    <p>
                        Integer varius est orci, vel egestas felis dictum nec. Phasellus porta ex sit amet turpis finibus, sed
                        vestibulum nisl efficitur. Praesent ultrices diam enim. In ut tellus sed sem placerat sollicitudin.
                    </p>
                </div>
            </div>
        </div>
    </div>

@endsection


