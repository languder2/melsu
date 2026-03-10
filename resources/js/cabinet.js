import './bootstrap';

import select2 from 'select2';
select2();

import './matches/search.js';
import './matches/divisionUUID.js';

import 'bootstrap-icons/font/bootstrap-icons.css';

import './select2/base.js';
import './select2/categoryWithParents.js';
import './select2/tags.js';



$(document).ready(function() {

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

    let inputChangeTimeOut

    $('.document-external-link').change(function (){
        let value       = $(this).val()
        let form        = $(this).parents(`form`)
        let file        = $(form).find(`[name="file"]`)
        let filetype    = $(form).find(`[name="filetype"]`).val()

        file.prop('required', !value.length && !filetype)
        file.prop('disabled', value.length)

        console.log(filetype, value.length, !value.length && !filetype)
    }).keyup(function (){
        clearTimeout(inputChangeTimeOut)

        inputChangeTimeOut = setTimeout($(this).change(), 300)
    })

    $(`a[href="#copy"]`).click(function(){
        navigator.clipboard.writeText($(this).data('copy'));
        return false;
    })




});

