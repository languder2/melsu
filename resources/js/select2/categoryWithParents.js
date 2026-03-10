$(document).ready(function (){
    if ($.fn.select2)
        $('.jq-select2[name="category_id"]').on('select2:select', function (e) {

            let selectedID = parseInt(e.params.data.id)

            let $parent = $(".jq-select2[name='parent_id']")

            let $groups = $parent.find("optgroup")

            $groups.prop('disabled', function() {
                return selectedID !== $(this).data('category')
            });

            $parent.val(null)

            $parent.trigger('change.select2')

        });
})
