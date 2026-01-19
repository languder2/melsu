<form action="{{ $instance->user_access_cabinet_save }}" method="POST" class="flex flex-col gap-3" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <x-form.errors/>


    @props([
    'divisions' => collect(),
    'currents'  => collect(),
])

    <div id="blockSetDivisionAccess" class="flex flex-col gap-3 mt-4">

        <div class="flex gap-3 justify-between items-center">
            <h3 class="font-semibold text-xl">
                Список пользователей
            </h3>

            <input
                    type="submit"
                    value="Сохранить"
                    class="bg-sky-800 px-4 py-2 text-white rounded-md hover:bg-blue-700 active:bg-gray-700 cursor-pointer uppercase"
            >

        </div>

        <div class="bg-white p-3">
            <x-form.input
                    id="searchSDA"
                    label="Поиск"
            />
        </div>
        <div class="flex flex-col gap-3">
            @component('users.access.user', [
                'users' => $users,
                'currents'  => $list->pluck('id')
            ])@endcomponent
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', ()=>{
            const blockSDA   = document.getElementById(`blockSetDivisionAccess`);
            const listSDA    = blockSDA.querySelectorAll(`[type='checkbox']`);
            const labelsSDA  = blockSDA.querySelectorAll(`label:not([for='searchSDA'])`);
            const divisionsSDA  = document.getElementById(`divisionsSDA`);

            const summaryCheckedSDA = () => {
                let checkedSDA = blockSDA.querySelectorAll(`[type='checkbox']:checked`);

                let result = [];

                checkedSDA.forEach((el) => result.push(el.value))

                divisionsSDA.value = JSON.stringify(result)
            }

            listSDA.forEach((el) => {
                el.addEventListener('change', () => {
                    listSDA.forEach(
                        (sub)=> JSON.parse(sub.dataset.parents).includes(parseInt(el.value)) ? sub.checked = el.checked : null
                    )

                    summaryCheckedSDA()
                })
            });

            const searchSDA = document.getElementById('searchSDA');

            searchSDA.addEventListener('keyup', ()=>{
                labelsSDA.forEach((el) => {
                    el.classList.toggle(
                        'hidden',
                        !el.textContent.toLowerCase().includes(searchSDA.value.toLowerCase())
                        && searchSDA.value.length
                    )
                })
            })
        })
    </script>



</form>
