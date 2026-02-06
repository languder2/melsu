$(document).ready(function(){
    // $(`a[href="https://melsu/regiments"]`).hide()

    let timerForSearchDocumentInCategory
    let timerForSearchDocumentInAllCategories

    const searchDocuments = (element, search, main) => {
        let content = $(element).text().toLowerCase()

        if((content.includes(search) || !search) && (content.includes(main) || !main))
            $(element).slideDown()
        else
            $(element).slideUp()
    }
    const searchCategories = (element, main) => {
        let content = $(element).text().toLowerCase()

        let search = $(element).find(`.documents-search-box input`).val().toLowerCase()

        if(content.includes(main) || !main){
            $(element).slideDown()

            eachForSearch(searchDocuments, $(element).find(`.document`), search, main)
        }
        else
            $(element).slideUp()
    }

    const eachForSearch = (fn, list, search = null, main = null) => {
        list.each(function (){
            fn($(this), search, main)
        })

        return list.promise()
    }

    /* Show and hide documents in category */

    $('.showDocumentCategory').change(function(){

        let list = $(this).parent().find('.category-documents');

        let accordionPrefix = list.data('accordion');

        if (accordionPrefix)
            $(`[data-accordion="${accordionPrefix}"]`)
                .not(list)
                .slideUp(300);

        list.slideToggle(300)
    })

    /* Show panel Search in category*/

    $('.documents-category-wrapper .search-btn').click(function (){

        if(!$(this).parents('.documents-category-wrapper').find('.category-documents').is(":visible"))
            return;

        $(this).parents('.documents-category-wrapper').find('.documents-search-box').slideToggle(100)

        $(this).attr('open', () => !$(this).attr('open'))

    })

    /* Search in document category */

    $('.documents-category-wrapper .documents-search-box input').keyup(function(){
        clearTimeout(timerForSearchDocumentInCategory)

        timerForSearchDocumentInCategory = setTimeout(()=> {


            let wrapper     = $(this).parents('.documents-category-wrapper')
            let list        = wrapper.find('.document')
            let main        = $(`.document-search-main input`).val()?.toLowerCase().trim()
            let search      = $(this).val().toLowerCase()

            eachForSearch(searchDocuments, list, search, main )
                .done(function(){
                    if(list.filter(":visible").length)
                        wrapper.find(`.message-not-results-documents`).slideUp()
                    else
                        wrapper.find(`.message-not-results-documents`).slideDown()

                })


        },200)
    })

    /* Clear search in document category */

    $('.documents-category-wrapper .search-clear').click(function (){
        let main = $(`.document-search-main input`).val()?.toLowerCase().trim()

        $(this).parents('.documents-category-wrapper').find('.documents-search-box input').val(null)

        $(this).parents('.documents-category-wrapper').find('.document').each(function () {
            searchDocuments($(this), null, main)
        })
    })

    /* Show and hide all documents categories */

    $('.documentCategoriesShowAll').click(function() {
        $('.showDocumentCategory:not(:checked)').prop('checked', true).trigger('change');
    });

    $('.documentCategoriesHideAll').click(function() {
        $('.showDocumentCategory:checked').prop('checked', false).trigger('change');
    });


    /* Search in all documents categories */

    $(`.document-search-main input`).keyup(function(){

        clearTimeout(timerForSearchDocumentInAllCategories)

        let search = $(this).val().toLowerCase()

        timerForSearchDocumentInAllCategories = setTimeout(()=> {
            let list = $(`.documents-category-wrapper`)

            eachForSearch(searchCategories, list, search)
                .done(function(){
                    if(list.filter(":visible").length)
                        $(`.message-not-results-categories`).slideUp()
                    else
                        $(`.message-not-results-categories`).slideDown()
                })
        },200)
    })

    /* Clear search in all documents categories */

    $('.document-search-main .search-clear').click(function (){

        $(this).parents('.document-search-main').find('input').val(null)

        let list = $(`.documents-category-wrapper`)

        eachForSearch(searchCategories, list, null)
            .done(function(){
                if(list.filter(":visible").length)
                    $(`.message-not-results-categories`).slideUp()
                else
                    $(`.message-not-results-categories`).slideDown()
            })

    })


})
