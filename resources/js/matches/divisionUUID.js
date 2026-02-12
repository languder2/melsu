$(document).ready(function(){
    const divisionChangeUUID = async (link, value) => {
        try {
            const response = await axios.put(link, {
                uuid: value
            });
        } catch (error) {
        }
    };


    let timerInputMatchedUUID

    $(`input.inputMatchedUUID`).on('input', function(){

        clearTimeout(timerInputMatchedUUID)

        let uuid = $(this).val()
        let link = $(this).data('link')

        timerInputMatchedUUID = setTimeout(function(){
            divisionChangeUUID(link, uuid).then(r => '');
        }, 300)

    })


});
