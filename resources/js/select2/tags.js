$(document).ready(function (){
    if ($.fn.select2) {
        $('.tags').select2({
            tags: true,
            createTag: function (params) {
                let term = params.term ? params.term.trim() : '';

                return {
                    id: term,
                    text: term,
                    newTag: true
                }
            },
        })
            .on('select2:select', function (e) {
                let data = e.params.data
                let $select = $(this)

                if (data.newTag) {
                    $.ajax({
                        url: '/api/tags/create',
                        method: 'POST',
                        data: { 'tag': data.text, 'type': $select.data('type') ?? null },
                        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
                    })
                        .done((response) => {
                            let currentIds = $select.val()
                            let index = currentIds.indexOf(data.id)
                            if (index !== -1) {
                                currentIds.splice(index, 1)
                            }

                            currentIds.push(response.id.toString())

                            if ($select.find("option[value='" + response.id + "']").length === 0)
                                $select.append(new Option(response.text, response.id, true, true))

                            $select.val(currentIds)

                            $select.find("option").filter(function() {
                                return $(this).val() === data.id && $(this).text() === data.text
                            }).remove()

                            $select.trigger('change')
                        })
                }
            });
    }
})
