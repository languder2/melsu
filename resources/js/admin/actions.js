async function actionFetch(link, responseType = 'json') {
    try {
        const response = await fetch(link, { method: "GET" });
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }

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
        } else {
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

export async function addSection(block, link) {
    try {
        const html = await actionFetch(link, 'text');
        if (html) {
            block.insertAdjacentHTML("beforeend", html);
            console.log(html);
        }
    } catch (error) {
        console.error("Error in addSection:", error);
    }
}
