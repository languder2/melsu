<x-form.input
    id="search_staff"
    name="search_staff"
    label="Найти"
    value=""
/>


<div class="flex flex-col h-80 overflow-y-scroll mt-2">
    @foreach($list as $item)
        <div
            data-id="{{ $item->id }}"
            data-lastname="{{ $item->lastname }}"
            data-firstname="{{ $item->firstname }}"
            data-middle_name="{{ $item->middle_name }}"
            @class(['group hover:text-blue-700 cursor-pointer staff flex gap-3 px-3 py-2', $loop->iteration % 2 ? 'bg-gray-100' : ''])
            onclick="setStaff(this)"
        >
            <p class="w-10 text-center">
                {{ $item->id }}
            </p>
            <p class="flex-1">
                {{ $item->full_name }}
            </p>
            <p class="pe-3 group-hover:pe-0 duration-300">
                <i class="fas fa-caret-right"></i>
            </p>
        </div>
    @endforeach
</div>


<script>
    document.addEventListener("DOMContentLoaded", ()=>{
        document.getElementById('search_staff').addEventListener('keyup',()=>{
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

    function setStaff(el){
        document.getElementById('form_staff_id').value = el.getAttribute('data-id');
        document.getElementById('form_lastname').value = el.getAttribute('data-lastname');
        document.getElementById('form_firstname').value = el.getAttribute('data-firstname');
        document.getElementById('form_middle_name').value = el.getAttribute('data-middle_name');
    }




</script>
