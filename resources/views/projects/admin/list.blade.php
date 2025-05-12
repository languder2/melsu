@extends("layouts.admin")

@section('title', __('admin.Admin panel: ').__('projects.Projects'))

@section('top-menu')
    @include('projects.admin.includes.admin-menu')
@endsection

@section('content-header')
    @component('admin.components.content-header')

        {{__('projects.Projects')}}

        @slot('link')
            {{ route('projects.form') }}
        @endslot
    @endcomponent
@endsection

@section('content')

    <div class="flex flex-col gap-4">
        @foreach($clusters as $cluster)
            @continue($cluster->adminProjects()->isEmpty())
            @component('projects.admin.cluster',compact("cluster"))@endcomponent
        @endforeach

        <section
            class="p-4 bg-white shadow"
        >
            <div class="grid grid-cols-[auto_auto_2fr_1fr_auto] gap-4 bg-white p-4">
                <div class="font-semibold">
                    ID
                </div>
                <div class="font-semibold">
                    Sort
                </div>
                <div class="font-semibold">
                    Name
                </div>
                <div class="font-semibold">
                    Link
                </div>
                <div class="font-semibold">

                </div>

                @foreach($projects as $item)
                    @component('projects.admin.project',compact('item')) @endcomponent
                @endforeach
            </div>



        </section>


    </div>
@endsection
