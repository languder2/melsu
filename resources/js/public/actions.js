export function AltSelectShow(element){
    element.toggleAttribute('open');

    document.addEventListener('click', (event) => {
        if (!element.contains(event.target)) {
            element.removeAttribute('open');
        }
    });
}

export function AltSelectSet(element,block){
    block.querySelector('.select-value').value = element.getAttribute('data-code');
    block.querySelector('.select-text').innerText = element.innerText;

    element.closest('form').dispatchEvent(new Event('submit'));

}

export async function FormSend(form,block) {
    try {

        for(let el of block.children)
            el.classList.add('transition-all','duration-300','overflow-hidden','scale-y-0');

        let formData = new FormData(form);

        const response = await fetch(form.action, { method: "POST", body: formData });

        if (response.ok) {
            block.innerHTML = await response.text();
        } else {
            console.error(`HTTP error! status: ${response.status}`);
            // Обработка ошибки HTTP
        }

    } catch (error) {
        console.error("Error sending form:", error);
    }
}


let timeoutId;
export function KeyDownTimer(element){
    clearTimeout(timeoutId);
    timeoutId = setTimeout(()=>element.closest('form').dispatchEvent(new Event('submit')),300);
}


export function showBlock(blockClass,listClass){
    let list = document.querySelectorAll(listClass);

    if(!list)
        return;

    list.forEach(el=>{
       if(el.classList.contains(blockClass))
           el.classList.remove('max-h-0');
       else
           el.classList.add('max-h-0');
    });
}

export function toggleShowBlock(blockID){
    let block = document.getElementById(blockID);
    if(!block) return;

    block.style.maxHeight = (block.style.maxHeight !== '0px') ? '0px' : block.scrollHeight+'px';
}
