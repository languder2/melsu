import './bootstrap';

import select2 from 'select2';
select2();
$(document).ready(function() {
    if ($.fn.select2) {
        $('.jq-select2').select2({
            width: '100%',
            placeholder: $(this).data('placeholder'),
        });

        $('.jq-select2[name="category_id"]').on('select2:select', function (e) {
            let data = e.params.data;
            console.log(data.id);
        });

    } else {
        console.error('Select2 function not found!');
    }



});

