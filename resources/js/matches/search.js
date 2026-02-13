$(document).ready(function(){
    let timerQuickSearch;

    const quickSearch = (list, text) => {

        list.each(function () {
            const $item = $(this);
            const content = this.textContent.toLowerCase();

            if (text === '' || content.includes(text))
                $item.show();
            else
                $item.hide();
        });

        return list.promise()
    };

    $(`input[name="quickSearchInList"]`).on('input', function() {
        clearTimeout(timerQuickSearch);

        const text      = $(this).val().toLowerCase().trim();
        const blockID   = $(this).data(`search-block`);
        const list      = $(blockID).find(`.lineInSearch`);
        const counter   = $(blockID + `Counter`);

        timerQuickSearch = setTimeout(function() {
            quickSearch(list, text).then(function(){
                counter.html($(blockID).find(`.lineInSearch:visible`).length)
            });
        }, 300);
    });

    $(`.search-clear`).click(function(){
        $(this).parent().find(`input[name="quickSearchInList"]`).val(null).trigger('input')
    })
});
