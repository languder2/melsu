document.addEventListener('DOMContentLoaded', () => {
    const buttons = document.querySelectorAll(`.gsc-button`)
    const checkboxes = document.querySelectorAll(`[name='gsc']`)

    checkboxes.forEach(el => {
        el.addEventListener('change', (event) => {
            buttons.forEach(button => el.id === button.getAttribute('for')
                ? button.setAttribute('open', '')
                : button.removeAttribute('open')
            )
        })
    });

    document.querySelectorAll('.btnShowMore').forEach((btn)=>{
        btn.addEventListener('click',() => {
            const block = document.getElementById(btn.dataset.for)

            btn.toggleAttribute('open')

            block.style.maxHeight = btn.hasAttribute('open') ? block.scrollHeight + 'px' : '';
        })
    })
});
