export function specialitiesFilter(){
    const currentLevel = document.querySelector(`[name='speciality-level']:checked`).value
    const currentForm = document.querySelector(`[name='profiles-form']:checked`).value
    const currentBasis = document.querySelector(`[name='profiles-basis']:checked`).value

    document.querySelectorAll('.profile-check').forEach( item => {
        item.checked =
            (item.dataset.level === currentLevel || currentLevel === 'all')
            && item.dataset.form === currentForm
            && (item.dataset.basis === currentBasis  || item.dataset.basis === 'all')
    })

}
