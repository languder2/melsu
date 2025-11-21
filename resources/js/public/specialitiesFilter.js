export function specialitiesFilter(){
    const currentLevel = document.querySelector(`[name='speciality-level']:checked`).value
    const currentForm = document.querySelector(`[name='profiles-form']:checked`).value
    const currentBasis = document.querySelector(`[name='profiles-basis']:checked`).value
    const search = document.querySelector(`[name="profiles-search"]`).value

    document.querySelectorAll('.profile-check').forEach( item => {
        item.checked =
            (item.dataset.level === currentLevel || currentLevel === 'all')
            && item.dataset.form === currentForm
            && (item.dataset.basis === currentBasis  || item.dataset.basis === 'all')
            && (item.value.toLowerCase().includes(search.toLowerCase()) || search === '')


    })

    console.log(search)

}
let timeout
export function specialitiesSearch(){

    clearTimeout(timeout)
    timeout = setTimeout(() => specialitiesFilter(), 300)

}
