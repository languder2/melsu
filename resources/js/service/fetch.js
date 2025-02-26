export async function FetchPost(link,data) {

    const response = await fetch(link, { method: "POST", body: data });

    if (response.ok) {
        return response.text();
    }
}


