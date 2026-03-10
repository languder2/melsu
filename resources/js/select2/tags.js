$(document).ready(function (){
    if ($.fn.select2) {
        $('.tags').select2({
            tags: true,
            // createTag: function (params) {
            //     let term = params.term ? params.term.trim() : '';
            //
            //     $.ajax('/api/tags/create',{
            //         data: {
            //             'tag': term
            //         }
            //     })
            //     .done((data)=>{
            //         return data
            //     })
            // },
            ajax: {
                url: '/api/tags',
                dataType: 'json',
                processResults: function (data) {
                    return {
                        results: data.items
                    };
                }
            }
        })
        .on('select2:select', function (e) {
            let data = e.params.data;

            console.log(data)

            if (data.newTag) {
                console.log("Был создан новый тег:", data.text);
                // Здесь можно отправить AJAX запрос на сервер, чтобы сохранить новый тег в БД
            }
        });
    }
})
