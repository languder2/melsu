@props([
    'list'          => collect(),
    'division'      => new \App\Models\Division\Division()
])

@if($list->isNotEmpty())
    <div class="flex flex-col gap-7">
        <div class="flex">
            @foreach($list as $key => $group)
                <label
                    for="division-gsc-{{ $key }}"
                    @if($loop->first) open @endif
                    class="
                        gsc-button
                        py-2.5 px-7.5 cursor-pointer font-bold text-red-700 border border-red-700 transition
                        duration-300 ease-linear hover:text-white hover:bg-red-700 open:text-white open:bg-red-700
                    "
                >
                    {{ __("common.GSC $key") }}
                </label>
            @endforeach
        </div>

        @foreach($list as $key => $items)
            <div class="hidden group has-[:checked]:block">
                <input type="radio" name="gsc" id="division-gsc-{{ $key }}" class="peer gsc hidden" @checked($loop->first)>
                <div id="goals-faculty" class="flex flex-col gap-5">
                    <h2 class="font-bold mb-3 hidden">Основными задачами факультета являются:</h2>
                    <div class="grid md:grid-cols-2 gap-6">
                        @foreach($items as $level => $item)
                            @if($key === 'specialities')
                                <div class="flex flex-col gap-4">
                                    <h3 class="font-bold"> {{ __('common.GSC '.$level) }}: </h3>
                                    @foreach($item as $spec)
                                        <x-divisions.gsc-item :item="$spec" />
                                    @endforeach
                                </div>
                            @else
                                <x-divisions.gsc-item :item="$item" />
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endif
