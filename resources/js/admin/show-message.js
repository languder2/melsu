export async function message(text) {
    console.log('show message');
}
export async function hide(el) {
    el.classList.replace('max-h-60','max-h-0');
    el.classList.replace('mb-4','mb-0');
    setTimeout(()=>el.classList.add('hidden'),300)


}
