export function showTab(el, groupClass) {

    console.log(el, groupClass);

    let targetId = el.value;
    let tabs = document.querySelectorAll(groupClass);
    if (!targetId || !tabs) return;
    tabs.forEach(tab => tab.classList.toggle('hidden', tab.id !== targetId));
}
