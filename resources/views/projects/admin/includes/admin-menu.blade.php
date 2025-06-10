<nav class="bg-white p-4 flex">

    <x-html.a-blue
        href="{{ route('clusters.admin') }}"
        text="{{ __('projects.Clusters') }}"
    />

    <span class="inline-block mx-3 opacity-30">|</span>

    <x-html.a-blue
        href="{{ route('projects.admin') }}"
        text="{{ __('projects.Projects') }}"
    />

</nav>



