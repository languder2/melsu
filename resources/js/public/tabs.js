document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.tabContent').forEach(el=>{
        el.style.maxHeight = el.hasAttribute('open') ? (el.scrollHeight + el.clientHeight) + 'px' : 0
        el.classList.remove('max-h-0')
    })

    document.querySelectorAll('.tabs .tab').forEach(el=>{

        el.addEventListener('click', () => {
            if(el.hasAttribute('open'))
                return;

            el.closest('.tabs')
                .querySelectorAll('.tab')
                .forEach(el=> el.removeAttribute('open') )

            el.closest('.tabs-wrapper')
                .querySelectorAll('.tabContent[open]')
                .forEach(el=> {
                    el.style.maxHeight = 0
                    el.removeAttribute('open')
                })

            el.closest('.tabs-wrapper')
                .querySelectorAll(`.tabContent[data-tab='${el.dataset.tab}']`)
                .forEach( el => {
                    el.style.maxHeight = el.scrollHeight + 'px'
                    el.setAttribute('open', '')
                })

            el.setAttribute('open', '')
        })
    })
})
