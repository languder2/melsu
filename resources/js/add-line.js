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
        // plugins: 'code table lists image media link',
        plugins: [ "uploadcare", "code", "image", "media", "link", "preview", "lists", "table" ],
        toolbar: 'undo redo | styles  | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | table | link image media | code | preview',
        license_key: 'gpl',
        image_title: true,
        /* enable automatic uploads of images represented by blob or data URIs*/
        automatic_uploads: true,
        /*
          URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
          images_upload_url: 'postAcceptor.php',
          here we add custom filepicker only to Image dialog
        */
        file_picker_types: 'image',
        /* and here's our custom image picker*/
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    /*
                      Note: Now we need to register the blob in TinyMCEs image blob
                      registry. In the next release this part hopefully won't be
                      necessary, as we are looking to handle it internally.
                    */
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);

                    /* call the callback and populate the Title field with the file name */
                    cb(blobInfo.blobUri(), { title: file.name });
                });
                reader.readAsDataURL(file);
            });

            input.click();
        }
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
