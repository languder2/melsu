<section
    class="p-4 bg-white shadow"
>
    <h3 class="font-semibold text-lg flex gap-4 justify-between">
        {!! $cluster->name !!}

        <a href="{{ $cluster->AddProject }}" class="
                rounded-md
                text-blue-950 hover:text-blue-700 active:text-gray-700
                flex items-center justify-center
            ">
            <i class="far fa-plus-square text-2xl"></i>
        </a>
    </h3>

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

        @foreach($cluster->adminProjects() as $item)
            @component('projects.admin.project',compact('item')) @endcomponent

        @endforeach
    </div>



</section>
