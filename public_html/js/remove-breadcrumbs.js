document.addEventListener('DOMContentLoaded',()=>{
        const pageHeader = document.querySelector('.page-header');
        if (pageHeader) {
            const parent = pageHeader.closest('.my-6');
            if (parent) {
                parent.style.display = 'none';
            }
        }
    });