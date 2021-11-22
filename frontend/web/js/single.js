

function getnextimg(param){

    var img = $('.img-66');

    $(param).siblings("a").toggleClass('blur');

    var count = Number($(param).attr('data-count'));

    var position = Number($(param).attr('data-position'));

    if (position <= count) {

        var id = $(param).attr('data-id');
        var object = $(param);

        $.ajax({
            type: 'POST',
            url: '/get-photo',
            data: 'id='+id+'&position='+position,
            dataType: "html",
            cache: false,
            success: function (data){
                $('.img-'+id).attr('src', data);
                $('.img-'+id).siblings('source').attr('srcset' , data);
                $('#single_image').attr('href', data);


                position++;
                if (position == count){
                    $(object).removeClass('d-flex');
                    $(object).addClass('d-none');
                }
                var positionPrev = position - 1;
                $(object).siblings(".prev-img-btn").attr('data-position' , positionPrev);

                $(object).siblings(".prev-img-btn").addClass('d-flex');
                $(object).attr('data-position' , position);

            },
        })
    }
}

function removeBlur(param){

    $(param).closest('a').removeClass('blur');

}

function getprevimg(param){

    var count = Number($(param).attr('data-count'));

    $(param).siblings("a").toggleClass('blur');

    var position = Number($(param).attr('data-position'));

    if (position <= count) {

        var id = $(param).attr('data-id');
        var object = $(param);

        var positionPrev = Number(position) - 1;

        $.ajax({
            type: 'POST',
            url: '/get-photo',
            data: 'id='+id+'&position='+positionPrev,
            dataType: "html",
            cache: false,
            success: function (data){

                $('.img-'+id).attr('src', data);
                $('.img-'+id).siblings('source').attr('srcset' , data);
                $('#single_image').attr('href', data);

                if (positionPrev < 0){
                    $(object).removeClass('d-flex');
                    $(object).addClass('d-none');
                }

                $(object).siblings(".next-img-btn").attr('data-position' , position);
                $(object).siblings(".next-img-btn").removeClass('d-none');

                $(object).attr('data-position' , positionPrev)

            },
        })
    }
}

function add_gal(){
    var singleGallery = $('.carousel-inner');
    singleGallery.lightGallery();
}

add_gal();

function get_recom_post(){

    var target = $('.footer');

    var id = '';

    $('[data-post-id]').each(function() {

        id = id + $(this).attr('data-post-id') + ',';

    });

    $.ajax({
        type: 'POST',
        url: '/getrecom',
        data: 'post_id='+id,
        async:false,
        dataType: "html",
        cache: false,
        success: function (data){

            if (data == ''){
                $('.preload-single').html('');
                $('.pop-heading').remove();
            }

            $('.recomend').append(data);

            $('.carousel').carousel();

            add_gal();

        },
    })

}

$(document).ready(
    get_recom_post()
);
