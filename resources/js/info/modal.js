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
export async function showModal() {
    if(document.getElementById('modal'))
        document.getElementById('modal').removeAttribute('hidden');
}

export async function sendModalForm() {

    let form = document.querySelector('#modal form');

    console.log(form);
}



