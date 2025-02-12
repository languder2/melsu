export async function copyTextToClipboard(text,message) {
    await navigator.clipboard.writeText(text);
    ShowMessage.message(message);
}
