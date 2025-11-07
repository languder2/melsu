document.addEventListener(`DOMContentLoaded`, ()=>{
    const searchSSWS = document.querySelectorAll(`.styled-select-with-search .search`);
    const buttonsSSWS = document.querySelectorAll(`.styled-select-with-search .button-ssws`);
    const variantsSSWS = document.querySelectorAll('.styled-select-with-search .variant')
    const closeSSWS = (target = null) => {
        buttonsSSWS.forEach(item =>
            (item.dataset.for === target && target!== null)
                ? item.toggleAttribute(`open`)
                : item.removeAttribute(`open`)
        )
    }

    const byClickHideOpenSSWS = (event) => {
        const openSSWS = document.querySelector(`.styled-select-with-search .button-ssws[open]`);

        if(openSSWS === null) return;

        const block = document.querySelector(`div[data-for="${openSSWS.dataset.for}"]`);

        if (!openSSWS.contains(event.target) && !block.contains(event.target))
            closeSSWS()
    }
    const byEscHideOpenSSWS = (event) => (event.key === 'Escape') ? closeSSWS() : null

    const getSelectedVariants = (target)=>{
        let result = [];

        const variants = document.querySelectorAll(`div[data-for="${target}"] .variant[open]`)

        variants.forEach(item => result.push(item.dataset.value))

        document.getElementById(target).value = JSON.stringify(result);
    }

    const stringWithoutLevel = (string) => string.indexOf("⤷ ") < 0 ? string : string.substring(string.indexOf("⤷ ") + 2)
    const getStringSSWS = (string) => {

        string = stringWithoutLevel(string)

        return  string.length > 40 ? string.slice(0, 37) + '...' : string

    }
    const deleteSelectedVariant = (target, value) => {
        document.querySelectorAll(`[data-ssws="${target}"] .selectedVariant[data-value="${value}"]`)
            .forEach( item => item.remove())

        document.querySelectorAll(`[data-ssws="${target}"] .variant[data-value="${value}"]`)
            .forEach( item => item.removeAttribute('open'))

        getSelectedVariants(target)
    }
    const showPanelSSWS = (target, item) => {
        let container = document.querySelector(`[data-ssws="${target}"] .selectedVariants`)

        const panel = document.createElement('div')
        const block = document.createElement('div')
        const button = document.createElement('div')

        panel.className = 'selectedVariant bg-sky-800 text-white whitespace-nowrap flex items-center'
        panel.setAttribute('data-value', item.dataset.value)

        block.className = 'ps-3 pe-2 py-2'
        block.textContent = getStringSSWS(item.innerText)
        panel.appendChild(block)

        button.className = "px-3 py-2 cursor-pointer hover:bg-blue-800"
        button.textContent = "x"
        button.addEventListener('click', (event) => deleteSelectedVariant(target, item.dataset.id))
        panel.appendChild(button)

        container.insertBefore(panel, container.lastElementChild)

        getSelectedVariants(target)
    }

    const changeSelectedVariantSSWS = (target, item) => {
        item.toggleAttribute('open')

        item.hasAttribute('open')
            ? showPanelSSWS(target, item)
            : deleteSelectedVariant(target, item.dataset.value)
    }

    const search = (target, value)=>{
        const empty = document.querySelector(`.styled-select-with-search[data-ssws="${target}"] .emptyResults`);

        let variants = document.querySelectorAll(`.styled-select-with-search[data-ssws="${target}"] .variant`)

        variants.forEach(item => item.classList.toggle('hidden', !item.textContent.toLowerCase().includes(value.toLowerCase())))

        variants = document.querySelectorAll(`.styled-select-with-search[data-ssws="${target}"] .variant:not(.hidden)`)

        variants.length ? empty.classList.add('hidden') : empty.classList.remove('hidden')
    }

    buttonsSSWS.forEach(item => {
        item.addEventListener(`click`, (event) => closeSSWS(event.target.dataset.for))
    })

    document.addEventListener(`click`, (event) => byClickHideOpenSSWS(event))

    document.addEventListener(`keyup`, (event) => byEscHideOpenSSWS(event))

    variantsSSWS.forEach((item) =>
        item.addEventListener('click', (event) => {
            changeSelectedVariantSSWS(item.closest('[data-for]').dataset.for, item)
        })
    )

    searchSSWS.forEach((item)=> item.addEventListener('keyup',()=> search(item.dataset.for, item.value)))

    variantsSSWS.forEach((item) =>{
        const target = item.closest('[data-ssws]').dataset.ssws

        if(item.hasAttribute('open'))
            showPanelSSWS(target, item)
    })

})
