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
                // plugins: 'code table lists image media link',
                plugins: [ "uploadcare", "code", "image", "media", "link", "preview", "lists", "table" ],
                toolbar: 'undo redo | styles  | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | table | link image media | code | preview',
                license_key: 'gpl',
                image_title: true,
                /* enable automatic uploads of images represented by blob or data URIs*/
                automatic_uploads: true,
                /*
                  URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                  images_upload_url: 'postAcceptor.php',
                  here we add custom filepicker only to Image dialog
                */
                file_picker_types: 'image',
                /* and here's our custom image picker*/
                file_picker_callback: (cb, value, meta) => {
                    const input = document.createElement('input');
                    input.setAttribute('type', 'file');
                    input.setAttribute('accept', 'image/*');

                    input.addEventListener('change', (e) => {
                        const file = e.target.files[0];

                        const reader = new FileReader();
                        reader.addEventListener('load', () => {
                            /*
                              Note: Now we need to register the blob in TinyMCEs image blob
                              registry. In the next release this part hopefully won't be
                              necessary, as we are looking to handle it internally.
                            */
                            const id = 'blobid' + (new Date()).getTime();
                            const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                            const base64 = reader.result.split(',')[1];
                            const blobInfo = blobCache.create(id, file, base64);
                            blobCache.add(blobInfo);

                            /* call the callback and populate the Title field with the file name */
                            cb(blobInfo.blobUri(), { title: file.name });
                        });
                        reader.readAsDataURL(file);
                    });

                    input.click();
                }
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
