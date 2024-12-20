document.addEventListener("DOMContentLoaded", ()=>{
    console.log('load');

    let list = document.querySelectorAll(".addLine");

    if(list === null) return false;

    list.forEach(el=>{
        el.addEventListener('click',(e)=>{
           e.preventDefault();

           addLine(
               el.getAttribute('href'),
               el.getAttribute('data-ident'),
               el.getAttribute('data-block')
           );

        });
    })

});
function addLine(href,ident,id){

    let block = document.getElementById(id);
    if(block === null) return false;

    let rows = block.querySelectorAll('[data-ident='+ident+']');
    if(rows === null) return false;

    let last = parseInt(rows[rows.length-1].getAttribute('data-last'))+1;

    href+= '/' + last;

    fetch(href,{
        method:         "GET",
    })
        .then(response => {return response.text();})
        .then(data => {
            block.insertAdjacentHTML("beforeend", data);
        });
}
