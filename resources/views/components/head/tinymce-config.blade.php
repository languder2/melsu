
<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    const commonConfig = {
        license_key: 'gpl',
        image_title: true,
        automatic_uploads: true,
        file_picker_types: 'image',
        file_picker_callback: (cb, value, meta) => {
            const input = document.createElement('input');
            input.setAttribute('type', 'file');
            input.setAttribute('accept', 'image/*');

            input.addEventListener('change', (e) => {
                const file = e.target.files[0];

                const reader = new FileReader();
                reader.addEventListener('load', () => {
                    const id = 'blobid' + (new Date()).getTime();
                    const blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                    const base64 = reader.result.split(',')[1];
                    const blobInfo = blobCache.create(id, file, base64);
                    blobCache.add(blobInfo);
                    cb(blobInfo.blobUri(), { title: file.name });
                });
                reader.readAsDataURL(file);
            });

            input.click();
        }
    };


    tinymce.init({
        selector: 'textarea.editor',
        plugins: [ "uploadcare", "code", "image", "media", "link", "preview", "lists", "table", "autoresize" ],
        toolbar: 'undo redo | styles  | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | table | link image media | code | preview',
        min_height: 553,
        max_height: 1053,
        ...commonConfig
    });

    tinymce.init({
        selector: '#formNewsShort',
        plugins: [ "code", "link", "preview", "lists", "autoresize" ],
        toolbar: 'undo redo | styles  | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | link code | preview',
        min_height: 300,
        max_height: 800,
        ...commonConfig
    });
</script>
