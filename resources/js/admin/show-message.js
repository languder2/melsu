export async function message(message) {
    let box = document.getElementById('adminMessageBox');

    if(!box) return;

    let div = box.querySelector('.example').cloneNode(true);

    div.querySelector('.message-time').innerText = new Date().toLocaleTimeString();
    div.querySelector('.message-content').innerText= message;


    div.classList.remove('hidden','example');
    div.addEventListener('click',()=>ShowMessage.hide(div));

    await box.appendChild(div);

    setTimeout(() => { // Запускаем анимацию в следующем кадре
        div.classList.replace('opacity-0', 'opacity-100');
        div.classList.replace('max-h-0','max-h-60');
        div.classList.replace('mt-0', 'mt-4');
    },10);

    setTimeout(()=>hide(div),1.1*60*1000);


}
export async function hide(el) {
    el.classList.replace('max-h-60','max-h-0');
    el.classList.replace('mt-4','mt-0');
    el.classList.replace('opacity-100','opacity-0');
    setTimeout(()=>el.destroy,1000);
}
