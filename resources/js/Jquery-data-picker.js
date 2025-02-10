$(function () {
    $('.dataRange').daterangepicker({
        "locale": {
            "format": "MM-DD-YYYY",
            "separator": " - ",
            "applyLabel": "Сохранить",
            "cancelLabel": "Назад",
            "daysOfWeek": [
                "Вс",
                "Пн",
                "Вт",
                "Ср",
                "Чт",
                "Пт",
                "Сб"
            ],
            "monthNames": [
                "Январь",
                "Февраль",
                "Март",
                "Апрель",
                "Май",
                "Июнь",
                "Июль",
                "Август",
                "Сентябрь",
                "Октябрь",
                "Ноябрь",
                "Декабрь"
            ],
            "firstDay": 1
        },
        opens: 'center',
        singleDatePicker: false,
        applyButtonClasses: 'smbtDate',
        startDate: new Date(),
        endDate: new Date(),
    });

    $('input[name="daterange"]').on('apply.daterangepicker', function (ev, picker) {
        let startD = picker.startDate.format('YYYY-MM-DD');
        let endD = picker.startDate.format('YYYY-MM-DD');
        window.location.href = "news/" + startD + "/" + endD;
    });

});
