
{{--<label class="my-3 block">--}}
{{--    <input type="text" value="" placeholder="Найти"--}}
{{--        class="py-2 border-b border-dashed w-full outline-0"--}}
{{--    >--}}
{{--</label>--}}

<x-form.input
    id="search_staff"
    name="search_staff"
    label="Найти"
    value=""
/>


<div class="flex flex-col h-80 overflow-y-scroll mt-2">
    @foreach($list as $item)
        <div data-id="{{ $item->id }}" @class(['staff flex gap-3 px-3 py-2', $loop->iteration % 2 ? 'bg-gray-100' : ''])>
            <p class="w-10 text-center">
                {{ $item->id }}
            </p>
            <p class="flex-1">
                {{ $item->full_name }}
            </p>
            <p class="">
                ->
            </p>
        </div>
    @endforeach
</div>


<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById('search_staff').addEventListener('keydown',()=>{
            document.getElementById('search_staff').dispatchEvent(new Event('change'));
        })

        document.getElementById('search_staff').addEventListener('change',()=>{

            let value = document.getElementById('search_staff').value;

            document.querySelectorAll('.staff').forEach((el)=>{
                el.classList.toggle(
                    'hidden',
                    !el.textContent.toLowerCase().includes(value.toLowerCase())
                )
            });
        })
    });

</script>
