export function Accordion(element){
    let block       = element.closest('.accordion-item');

    if(!block) return;

    element.toggleAttribute('open');

    let content     = block.querySelector('.accordion-content');
    if(!content)
        return;

    content.style.height = content.offsetHeight ? 0 : content.scrollHeight+'px';
}
