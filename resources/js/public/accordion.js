export function Accordion(element, force = false){
    let block       = element.closest('.accordion-item');

    if(!block) return;

    element.toggleAttribute('open');

    let content     = block.querySelector('.accordion-content');
    if(!content)
        return;

    if(force)
        content.style.height = content.scrollHeight+'px';
    else
        content.style.height = content.offsetHeight ? 0 : content.scrollHeight+'px';
}
