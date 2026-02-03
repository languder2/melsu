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

            let selectedID = e.params.data.id

            let $parent = $(".jq-select2[name='parent_id']")

            let $groups = $parent.find("optgroup")


            $groups.prop('disabled', function() {
                return selectedID != $(this).data('category')
            });

            $parent.val(null)

            $parent.trigger('change.select2')

        });

    } else {
        console.error('Select2 function not found!')
    }


    $('.showDocumentCategory').change(function(){
        $.ajax({
            method: "GET",
            url: "/api/cabinetDocumentCategoryChangeShowList",
            data: { status: $(this).is(':checked'), value: $(this).val() }
        })
            .done(function( data ) {
                console.log(data)
            });
    });


    $('#inAccordion').change(function(){
        $('#accordionPrefix').prop('disabled', !$(this).is(':checked'))
    });




});

