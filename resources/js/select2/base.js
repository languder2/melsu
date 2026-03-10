$(document).ready(function (){
    if ($.fn.select2)
        $('.jq-select2').select2({
            width: '100%',
            placeholder: $(this).data('placeholder'),
        });
})
