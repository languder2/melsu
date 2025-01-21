export function LimitList(selectID,attr,value){
    let select = document.getElementById(selectID);

    if(select === null) return false;

    let options = select.querySelectorAll('option');

    options.forEach(option =>{
        if(option.value === '') return '';

        if(option.getAttribute(attr) === value){
            option.removeAttribute('disabled');
            option.classList.remove('hidden');

        }
        else{
            option.setAttribute('disabled','disabled');
            option.classList.add('hidden');
        }
    });

    select.value = '';
}
