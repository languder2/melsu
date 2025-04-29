
document.addEventListener('DOMContentLoaded', event => {
    RegimentMembersShow()
});
window.addEventListener('hashchange', event=> {
    RegimentMembersShow()
});
function RegimentMembersShow(){
    if(!window.location.hash)
        return;

    let element = document.querySelector(''+window.location.hash+'');

    if(!element) return;

    window.Accordion(element,true);

    window.Scrolls.scrollToElementWithOffset(element,80);
}

