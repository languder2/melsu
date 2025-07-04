export async function FetchPost(link,data) {

    const response = await fetch(link, { method: "POST", body: data });

    if (response.ok) {
        return response.text();
    }
}
export async function FetchGet(link) {
    const response = await fetch(link, { method: "GET" });

    if (response.ok)
        return response.text();

}


