export function byAttribute(classNameFilter,classNameBlock, attribute, value){
    let filterItems = document.getElementsByClassName(classNameFilter);

    if(filterItems){
        filterItems.forEach(el=>{
            el.toggleAttribute(
                'open',
                el.hasAttribute('data-letter')
                && el.getAttribute('data-letter') === value
            );
        });
    }

    let list = document.getElementsByClassName(classNameBlock);

    if(!list)
        return;

    if(!value)
        list.forEach(el=>{
            el.classList.remove('hidden');
        });
    else
        list.forEach(el=>{
            el.classList.toggle('hidden',
                el.hasAttribute('data-letter')
                && el.getAttribute('data-letter') !== value
            );
        });

}
