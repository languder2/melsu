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
