export async function ToggleShow(el, link) {
    el.closest('label').classList.add('pointer-events-none');
    try {
        await galleryFetch(link);
    } finally {
        el.closest('label').classList.remove('pointer-events-none');
    }
}

export async function DeleteItem(el, link) {
    el.classList.add('pointer-events-none');

    el.style.maxWidth = el.clientWidth;
    el.classList.remove('min-w-60');
    el.style.maxWidth = 0;
    // console.log(el.clientWidth)
//    el.classList.replace('min-w-60','max-w-0')

//   el.classList.add('scale-0');
//    setTimeout(()=>{el.classList.replace('min-w-60','max-w-0')},300)
    // try {
    //     await galleryFetch(link);
    // } finally {
    //     el.classList.toggle('pointer-events-none');
    // }
}

async function galleryFetch(link) {
    try {
        const response = await fetch(link, { method: "GET" });
        console.log(`Status: ${response.status}`);

        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

        const data = await response.text();
        const parsedData = JSON.parse(data);
        ShowMessage.message(parsedData.message);
    } catch (error) {
        console.error(`Error: ${error}`);
        ShowMessage.message("Произошла ошибка при выполнении запроса.");
    }
}
