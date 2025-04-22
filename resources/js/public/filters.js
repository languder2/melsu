export function byAttribute(className, attribute, value){
    let list = document.getElementsByClassName(className);

    if(!list)
        return;

    list.forEach(el=>{
        el.classList.toggle('hidden',el.hasAttribute('data-letter') && el.getAttribute('data-letter') !== value);
    });


}
