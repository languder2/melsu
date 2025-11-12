@props([
    'divisions' => collect(),
    'currents'  => collect(),
])

<div id="blockSetDivisionAccess" class="flex flex-col gap-3 mt-4">
    <h3 class="font-semibold text-xl">
        Подразделения
    </h3>
    <div class="bg-white p-3">
        <x-form.input
            id="searchSDA"
            label="Поиск"
        />
    </div>
    <div class="flex flex-col gap-3">
        @component('users.cabinet.division', [
            'divisions' => $divisions,
            'currents'  => $currents
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
