function check_anket(object){

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/post/check',
        data: 'id='+id,
        async:false,
        dataType: "html",
        beforeSend: function(){
            $(object).text('Отправка запроса..')
        },
        cache: false,
        success: function (data) {
            $(object).text('Подтверждено')
        },
        error: function (data) {
            $(object).text('Ошибочка')
        }

    });

}
function check_comments(object){

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/comments/check',
        data: 'id='+id,
        async:false,
        dataType: "html",
        beforeSend: function(){
            $(object).text('Отправка запроса..')
        },
        cache: false,
        success: function (data) {
            $(object).text('Подтверждено')
        },
        error: function (data) {
            $(object).text('Ошибочка')
        }

    });

}