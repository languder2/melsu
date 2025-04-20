async function actionFetch(link, responseType = 'json') {
    try {
        let response = await fetch(link, { method: "GET" });

        if (!response.ok)
            throw new Error(`HTTP error! status: ${response.status}`);

        let data;
        if (responseType === 'json') {
            data = await response.text();
            try {
                data = JSON.parse(data);
            } catch (jsonError) {
                console.error("Error parsing JSON:", jsonError);
                ShowMessage.message("Ошибка обработки данных.");
                return null;
            }
        } else{
            data = await response.text();
        }

        if (data && data.message) {
            ShowMessage.message(data.message);
        }
        return data;

    } catch (error) {
        console.error(`Error: ${error}`);
        ShowMessage.message("Произошла ошибка при выполнении запроса.");
        return null;
    }
}

export async function ToggleShow(el, link) {
    el.closest('label').classList.add('pointer-events-none');
    try {
        await actionFetch(link);
    } catch (error) {
        // Обработка ошибки, если необходимо
    }
    el.closest('label').classList.remove('pointer-events-none');
}

export async function DeleteItem(el, link) {
    el.classList.add('pointer-events-none');
    try {
        await actionFetch(link);
    } catch (error) {
        // Обработка ошибки, если необходимо
    }
    el.classList.add('scale-0');
    setTimeout(() => el.parentNode.removeChild(el), 200);
}

export async function addSection(block, link, reinit = false) {
    try {
        const html = await actionFetch(link, 'text');
        if (html)
            block.insertAdjacentHTML("beforeend", html);

        if(reinit)
            tinymce.init({
                selector: 'textarea.editor', // Replace this CSS selector to match the placeholder element for TinyMCE
                plugins: 'code table lists image',
                license_key: 'gpl',
                toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
            });

    } catch (error) {
        console.error("Error in addSection:", error);
    }
}

export async function DeleteSection(element,blockClass)
{

    console.log(blockClass,element,element.href);

    element.classList.add('pointer-events-none');
    try {
        await actionFetch(element.href);
    } catch (error) {}
    finally {
        element.closest(blockClass).parentNode.removeChild(element.closest(blockClass));
    }
}



export function showTab(targetId, groupClass) {
    let tabs = document.querySelectorAll(groupClass);
    if (!targetId || !tabs) return;
    tabs.forEach(tab => tab.classList.toggle('hidden', tab.id !== targetId));
}

export async function VacatePosition(block,blockClass,destroy = false)
{

    block.classList.add('pointer-events-none');
    try {
        await actionFetch(block.href);
    } catch (error) {}
    finally {

        if(destroy){
            block.closest(blockClass).parentNode.removeChild(block.closest(blockClass));
        }
        else{
            block.closest(blockClass).querySelector('input.staffID').value = null
            block.closest(blockClass).querySelector('input.staffFullName').value = null

            block.classList.remove('pointer-events-none');
        }


    }
}

export async function addStaffPosition(btn,id){

    btn.classList.add('pointer-events-none');

    let block = document.getElementById(id);

    if(!block || !btn.href)
        return ShowMessage.message("Ошибка обработки данных. Свяжитесь с администратором");

    await addSection(block,btn.href);

    btn.classList.remove('pointer-events-none');

    return ShowMessage.message("Позиция сотрудника добавлена");

}

export async function changeSelectOptions(blockID, link)
{

    let select = document.getElementById(blockID);

    if(!select) return;

    select.querySelectorAll('option').forEach(el=> {
        if(el.value)
            el.remove()
    });

    let options = await actionFetch(link, 'collection');

    options = JSON.parse(options);

    for (let [it, row] of Object.entries(options)) {
        let option = document.createElement('option');
        option.value = row.id;
        option.text = row.name;
        select.appendChild(option);
    }

}
