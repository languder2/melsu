document.addEventListener('DOMContentLoaded',()=>{

    const dropZone = document.getElementById('dropZone');
    if (dropZone) {
        let hoverClassName = 'hover';

        dropZone.addEventListener("dragenter", function(e) {
            e.preventDefault();
            dropZone.classList.add(hoverClassName);
        });

        dropZone.addEventListener("dragover", function(e) {
            e.preventDefault();
            dropZone.classList.add(hoverClassName);
        });

        dropZone.addEventListener("dragleave", function(e) {
            e.preventDefault();
            dropZone.classList.remove(hoverClassName);
        });

        // Это самое важное событие, событие, которое дает доступ к файлам
        dropZone.addEventListener("drop", function(e) {
            e.preventDefault();
            dropZone.classList.remove(hoverClassName);

            const files = Array.from(e.dataTransfer.files);
            console.log(files);
        });
    }

})
