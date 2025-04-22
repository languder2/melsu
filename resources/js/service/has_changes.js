import {Accordion} from "@/public/accordion.js";

window.addEventListener('hashchange', event=> {
    let element = document.querySelector(''+window.location.hash+'');
    if(element)
        Accordion(element);
});


