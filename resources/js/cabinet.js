// import './bootstrap';
document.addEventListener('DOMContentLoaded',()=>{
    console.log('load2');
});

import EditorJS from '@editorjs/editorjs';

const editor = new EditorJS({
    holder: 'editorjs',
});
