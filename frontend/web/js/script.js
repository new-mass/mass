
function make_filter(){

    $( "#slider-range-price" ).slider({
        range: true,
        min: 1000,
        max: 10000,
        values: [ $( "#findmodel-min_price" ).val(), $( "#findmodel-max_price" ).val() ],
        slide: function( event, ui ) {

            $( "#findmodel-min_price" ).val( ui.values[ 0 ] );
            $( "#findmodel-max_price" ).val( ui.values[ 1 ] );

            $('.price-range-wrap .min').html(ui.values[ 0 ] );
            $('.price-range-wrap .max').html(ui.values[ 1 ] );

        },
        create: function (event, ui) {
            $('.price-range-wrap .min').html($( "#findmodel-min_price" ).val());
            $('.price-range-wrap .max').html($( "#findmodel-max_price" ).val());
        },
    });

    $( "#slider-age").slider({
        range: true,
        min: 18,
        max: 99,
        values: [ $( "#findmodel-min_age").val(), $( "#findmodel-max_age").val() ],
        slide: function( event, ui ) {

            $( "#findmodel-min_age").val( ui.values[ 0 ] );
            $( "#findmodel-max_age").val( ui.values[ 1 ] );

            $('.age-range-wrap .min').html(ui.values[ 0 ] );
            $('.age-range-wrap .max').html(ui.values[ 1 ] );

        },
        create: function (event, ui) {
            $('.age-range-wrap .min').html($( "#findmodel-min_age").val());
            $('.age-range-wrap .max').html($( "#findmodel-max_age").val());
        },
    });
}

$(document).ready(function () {

    $.getScript( "/js/jquery-ui.min.js", function( data, textStatus, jqxhr ) {
        make_filter();
    });


    $('.carousel').carousel();

    $( ".sort_select").change(function() {

        var redirectUrl = location.pathname ;

        if ($('.sort_select').val()){

            var redirectUrl = location.pathname + '?' + $('.sort_select').val();

        }

        window.location.href = redirectUrl;

    });

    $('#toTop').click(function() {

        $('body,html').animate({scrollTop:0},800);

    });

    $.ajax({
        type: 'POST',
        url: '/view/count',
        dataType: "html",
        cache: false,
        success: function (data) {
            $('#prosmotri-count').html(data);
        },

    });

    $("#comments-mark").change(function () {

        $(this).siblings('.control-label').text('Оценка ' + $(this).val());

    });
    $(".show-menu").on('click', function () {

        $(".menu").addClass('open-menu');
        $('body').css('overflow', 'hidden');
    });

    $(".close-menu").on('click', function () {

        $(".menu").removeClass('open-menu');
        $('body').css('overflow', 'inherit');
    });


    $(".quantity-arrow-plus-1").click(function () {

        $(this).closest('.quantity').siblings(".form-group").children('input').val(Number($(this).closest('.quantity').siblings(".form-group").children('input').val()) + 1)

    });


    $(".quantity-arrow-minus-1").click(function () {

        if ($(this).closest('.quantity').siblings(".form-group").children('input').val() > 0) {
            $(this).closest('.quantity').siblings(".form-group").children('input').val(Number($(this).closest('.quantity').siblings(".form-group").children('input').val()) - 1);
        }

    });


});

function redirect(object){

    window.open($(object).attr('data-url'), '_blank');

}

function debounce(func, wait, immediate) {
    var timeout;
    return function() {
        var context = this, args = arguments;
        var later = function() {
            timeout = null;
            if (!immediate) func.apply(context, args);
        };
        var callNow = immediate && !timeout;
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
        if (callNow) func.apply(context, args);
    };
}
var changeURL = debounce(function() {
    $('[data-page-url]').each(function() {

        if (inView($(this))) {

            if(location.pathname + window.location.search !== $(this).attr('data-page-url') ){

                window.history.pushState('', document.title, $(this).attr('data-page-url'));

                yaCounter50332519.hit($(this).attr('data-page-url'));

                ga('send', {
                    hitType: 'pageview',
                    page: location.pathname + window.location.searc
                });

            }

        }
    });
}, 1);

$(document).ready(function () {

    $('.teh-pod').on('click', function () {

        $.ajax({
            type: 'POST',
            url: '/get-claim-modal',
            dataType: "html",
            cache: false,
            success: function (data) {

                $('#myModal').modal('show');
                $('#claim-modal .modal-body').html(data);

            },

        });

    });

    $('.open-filter-btn').on('click', function () {
        $('.mobile-filter-content-wrap').toggle(150);
        $('.open-filter-btn span').toggle(10);
    });

});

$(document).scroll(function () {

    $('#toTop').show(100);

    changeURL();

})

function get_more(){
    getMorePosts();
}

function inView($elem) {
    var $window = $(window);

    var docViewTop = $window.scrollTop();
    var docViewBottom = docViewTop + $window.height();

    var elemTop = $elem.offset().top;
    var elemBottom = elemTop + $elem.height();

    return ((elemBottom <= docViewBottom) && (elemTop >= docViewTop));
}
$(document).ready(function () {

});

function hide_comment(object) {

    var id = $(object).attr("data-id");

    $.ajax({
        type: 'POST',
        url: '/cabinet/comment/hide',
        data: 'id='+id,
        dataType: "html",
        cache: false,
        success: function (data) {

            $(object).text('Комментарий скрыт');

        },

    });


}

function show_comment(object) {

    var id = $(object).attr("data-id");

    $.ajax({
        type: 'POST',
        url: '/cabinet/comment/show',
        data: 'id='+id,
        dataType: "html",
        cache: false,
        success: function (data) {

            $(object).text('Комментарий показан');

        },

    });


}
function getAnketClaim(object) {

    var id = $(object).attr("data-id");

    $('#claim-modal .modal-body').html('');

    $.ajax({
        type: 'POST',
        url: '/claim/post/get-modal',
        data: 'id='+id,
        dataType: "html",
        cache: false,
        success: function (data) {

            $('#claim-modal').modal('show');
            $('#claim-modal .modal-body').html(data);

        },

    });
}
function getCall(object) {

    var id = $(object).attr("data-id");

    $('#claim-modal .modal-body').html('');

    $.ajax({
        type: 'POST',
        url: '/call/get',
        data: 'id='+id,
        dataType: "html",
        cache: false,
        success: function (data) {

            $('#claim-modal').modal('show');
            $('#claim-modal .modal-body').html(data);

            $.getScript("/js/jquery.maskedinput.min.js", function(data, textStatus, jqxhr) {
                $("#requestcall-phone").mask("+7 (999) 99-99-999");
            });

        },

    });
}

function getPhone(object) {

    var id = $(object).attr("data-id");

    var phone = $(object).attr("data-phone");

    var info = 'id=' + id;

    if ($(object).text() == 'Показать телефон') {

        $(object).closest(".custom-card-right").addClass('open-cart');

        $.ajax({
            type: 'POST',
            url: '/phone',
            data: info,
            dataType: "html",
            beforeSend: function(){
                $(object).html('<img style="height: 27px" id="imgcode" src="/img/pre.gif">');
            },
            cache: false,
            success: function (data) {

                $(object).html(phone);
                window.location.href="tel: +"+phone;

            },

        });

        $(object).html(phone);

    }

}



function show_text() {
    $('.page-text-wrap').addClass('page-text-wrap-open')
}

function send_comment(object) {

    var formData = new FormData($(object).closest('form')[0]);
    $.ajax({
        url: '/comment/add',
        type: 'POST',
        data: formData,
        datatype: 'json',
        // async: false,
        beforeSend: function () {

        },
        success: function (data) {
            $('.comment-submit').html(data)
        },

        complete: function () {
            // success alerts
        },

        error: function (data) {
            alert("Ошибка");
        },
        cache: false,
        contentType: false,
        processData: false
    });

}

var fileField = document.getElementById('addpostform-gallary');
var preview = document.getElementById('preview');

if (fileField){

    fileField.addEventListener('change', function (event) {
        $('.no-img-item').remove();
        for (var x = 0; x < event.target.files.length; x++) {
            (function (i) {
                var reader = new FileReader();
                var img = document.createElement('img');
                var wrap = document.createElement('div');
                var col = document.createElement('div');
                reader.onload = function (event) {
                    wrap.setAttribute('class', 'gallery-img-wrap img-wrap');
                    col.setAttribute('class', 'col-2');
                    img.setAttribute('src', event.target.result);
                    img.setAttribute('class', 'preview');
                    col.appendChild(wrap.appendChild(img));
                    preview.appendChild(col);
                }
                reader.readAsDataURL(event.target.files[x]);
            })(x);
        }
    }, false);

}

function publication(obj) {

    var id = $(obj).attr('data-id');

    $.ajax({
        url: '/user/publication/update',
        type: 'POST',
        data: 'id=' + id,
        datatype: 'json',
        success: function (data) {
            $(obj).html(data);
        },

    });

}

function getMorePosts() {

    var object = $('.get-more-post-list');

    var url = $(object).attr("data-url");

    var offset = $(object).attr("data-offset");
    var limit = $(object).attr("data-limit");

    var dataOffset = Number(offset) + Number(limit);

    $('.preload').css('display' , 'block');


    $.ajax({
        type: 'POST',
        url: '/get-more-post-list',
        data: 'url=' +url+'&offset='+offset,
        async:false,
        dataType: "html",
        beforeSend: function(){

            $(object).attr("data-offset" , dataOffset);

            if (Number(offset) > 20) {
            }

        },
        cache: false,
        success: function (data) {

            if (data == ''){
                $('.preload').html();
                $(object).remove();
                $('.pagination').remove();
                $('.get_more').remove();
            }

            $('.preload').css('display' , 'none');

            $(".fisrst-content").removeClass('ankets-bg');
            $(".fisrst-content").append(data);

            $('.carousel').carousel();

        },

    });

}
function up_anket(object){

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/cabinet/up',
        data: 'id=' +id,
        async:false,
        dataType: "html",
        beforeSend: function(){
            $(object).text('Отправка запроса...');
        },
        cache: false,
        success: function (data) {
            $(object).text(data);
        },

    });

}

$( "#addpostform-video" ).change(function() {
    $( ".get-video-btn" ).text('Видео выбрано');
    $( ".video-cabinet" ).remove();

});

function delete_photo(object){

    var id = $(object).attr('data-id');

    $.ajax({
        type: 'POST',
        url: '/cabinet/delete-photo',
        data: 'id=' +id,
        async:false,
        dataType: "html",
        cache: false,
        success: function (data) {
            $(object).closest('.anket-photo-wrap').remove();
        },

    });

}

$('.update-avatar').change(function(){

    files = this.files;

    var formData = new FormData($(this).closest('form')[0]);

    var tmp = this;

    $.ajax({
        url: '/cabinet/update-avatar',
        type: 'POST',
        data: formData,
        datatype:'json',
        // async: false,
        beforeSend: function() {
            $(this).siblings('label').text('Загрузка');
        },
        success: function (data) {

            $(tmp).closest('.new-anket').find('.photo-list').attr('src', data );

        },

        complete: function() {
            // success alerts
        },

        error: function (data) {
            alert("There may a error on uploading. Try again later");
        },
        cache: false,
        contentType: false,
        processData: false
    });

});

$(document).ready(function () {
    $.uploadPreview({
        input_field: "#addpostform-image",   // Default: .image-upload
        preview_box: ".avatar-prewiew",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Загрузить основное фото",   // Default: Choose File
        label_selected: "Загрузить основное фото",  // Default: Change File
        no_label: false                 // Default: false
    });
});

$(document).ready(function () {
    $.uploadPreview({
        input_field: "#addpostform-image-check",   // Default: .image-upload
        preview_box: ".check-prewiew",  // Default: .image-preview
        label_field: "#image-label",    // Default: .image-label
        label_default: "Загрузить основное фото",   // Default: Choose File
        label_selected: "Загрузить основное фото",  // Default: Change File
        no_label: false                 // Default: false
    });
});