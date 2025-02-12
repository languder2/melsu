<script src="{{ asset('js/tinymce/tinymce.min.js') }}" referrerpolicy="origin"></script>
<script>
    tinymce.init({
        selector: 'textarea.editor', // Replace this CSS selector to match the placeholder element for TinyMCE
        plugins: 'code table lists image media link',
        toolbar: 'undo redo | blocks | bold italic | alignleft aligncenter alignright | indent outdent bullist numlist | table | link image media | code',
        license_key: 'gpl'
    });
</script>
