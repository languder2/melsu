document.addEventListener("DOMContentLoaded", () => {
    initRemoveBlock();
    initShowHideSection();

    let list = document.querySelectorAll(".addLine");

    if (list === null) return false;

    list.forEach(el => {
        el.addEventListener('click', (e) => {
            e.preventDefault();

            addLine(
                el.getAttribute('href'),
                el.getAttribute('data-block')
            );

        });
    })

});

export function addLine(href, id, callback) {

    let block = document.getElementById(id);

    if (block === null) return false;

    let newID = new Date().getTime();

    href += '/' + newID;

    fetch(href, {
        method: "GET",
    })
        .then(response => {
            return response.text();
        })
        .then(data => {
            block.insertAdjacentHTML("beforeend", data);
            reinitEditor();
            initShowHideSection();
            initRemoveBlock();
            if (callback)
                callback(arguments, newID);
        });

    return false;
}


function initRemoveBlock() {
    let list = document.querySelectorAll('.removeBlock');

    if (list === null) return false;

    list.forEach(el => {
        el.addEventListener("click", (e) => {
            e.preventDefault();
            let ident = el.getAttribute('data-ident');
            let ordinal = el.getAttribute('data-ordinal');

            let block = document.querySelector("[data-ident='" + ident + "'][data-ordinal='" + ordinal + "']");

            if (block !== null)
                block.remove();
        });
    });
}

function reinitEditor() {
    tinymce.init({
        selector: 'textarea.editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists image',
        license_key: 'gpl',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent | bullist numlist | code | table'
    });
}

function initShowHideSection() {

    let list = document.querySelectorAll('.showHideSection');

    if (list === null) return false;

    list.forEach(el => {


        el.addEventListener("click", (e) => {
            e.preventDefault();
            e.stopImmediatePropagation();

            let id = el.getAttribute('data-id');

            let block = document.getElementById(id).querySelector(".wrapper");

            if (block === null) return false;

            if (block.style.maxHeight !== '0px')
                block.style.maxHeight = "0px";
            else
                block.style.maxHeight = "1000px";

            console.log(block.style.maxHeight)
            return false;
        }, true);
    });

}


export function addStaff() {
    console.log('addStaff')
    return false;
}

export function test(el) {

    let id = new Date().getTime();


    console.log(el.getAttribute('href'), id);
    return false;
}

export function RemoveBLock(id) {
    document.getElementById(id).remove();
    return false;
}
