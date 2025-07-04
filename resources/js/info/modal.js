import {FetchGet} from "@/info/fetch.js";

document.addEventListener('DOMContentLoaded', ()=>{
    window.addEventListener('keydown', (e)=>{
        if(e.key === "Escape")
            closeModal().then();
    })
});

export async function closeModal() {
    if(document.getElementById('modal'))
        document.getElementById('modal').setAttribute('hidden','true');
}
export async function showModal(link) {
    let modal = document.getElementById('modal');
    let wrapper = document.getElementById('modal-wrapper');

    if(!modal || !wrapper) return;

    let data = FetchGet(link);

    data.then((body) => wrapper.innerHTML = body);

    modal.removeAttribute('hidden');
}

export async function sendModalForm() {

    let form = document.querySelector('#modal form');

    console.log(form);
}



