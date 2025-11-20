@props([
    'division'      => new \App\Models\Division\Division(),
])
<div class="pb-5">
    <section
        class="px-3 lg:pt-10 relative bg-no-repeat lg:bg-top bg-cover flex flex-wrap lg:min-h-100"
        style="background-image: url( {{ $division->image->src }} ); background-position: center center;"
    >
        <div class="bg-[rgba(40,13,13,0.6)] min-h-full min-w-full pointer-events-none absolute top-0 left-0">
        </div>
        <div class="container flex flex-col lg:flex-row pt-10 lg:pt-0 justify-start relative z-5 pb-5 lg:pb-10 gap-6 lg:items-end">
            <div>
                <h2 class="text-white font-bold text-2xl md:text-4xl 2xl:text-6xl ">
                    {{ $division->name }}
                </h2>
                {{ Breadcrumbs::view("vendor.breadcrumbs.education",$division->type->value,$division) }}
            </div>
        </div>
    </section>
</div>
