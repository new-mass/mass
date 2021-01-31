var singleGallery = $('.gallery .single-carousel');
singleGallery.lightGallery();
singleGallery.owlCarousel({
    items: 3,
    margin: 16,
    lazyLoad: true,
    nav: true,
    autoplay:true,
    autoplayTimeout:2000,
    navText: ['<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
    '                            <path d="M13.0487 7.10149C13.4393 7.49201 13.4393 8.12518 13.0487 8.5157L6.68478 14.8797C6.29426 15.2702 5.66109 15.2702 5.27057 14.8797C4.88004 14.4891 4.88004 13.856 5.27057 13.4654L10.9274 7.80859L5.27057 2.15174C4.88004 1.76122 4.88004 1.12805 5.27057 0.737526C5.66109 0.347002 6.29426 0.347002 6.68478 0.737526L13.0487 7.10149ZM0.258301 6.80859L12.3416 6.80859V8.80859L0.258301 8.80859L0.258301 6.80859Z" fill="white"></path>\n' +
    '                        </svg>', '<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
    '                            <path d="M1.14706 7.10149C0.756536 7.49201 0.756536 8.12518 1.14706 8.5157L7.51102 14.8797C7.90155 15.2702 8.53471 15.2702 8.92523 14.8797C9.31576 14.4891 9.31576 13.856 8.92523 13.4654L3.26838 7.80859L8.92523 2.15174C9.31576 1.76122 9.31576 1.12805 8.92523 0.737526C8.53471 0.347002 7.90155 0.347002 7.51102 0.737526L1.14706 7.10149ZM13.9375 6.80859L1.85417 6.80859V8.80859L13.9375 8.80859V6.80859Z" fill="white"></path>\n' +
    '                        </svg>'],
    navElement: 'a></a',
    responsive: {
        1024: {
            items: 3
        },
        768: {
            items: 3
        },
        0: {
            items: 2
        }
    }
});


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

$(window).scroll(function(){

    var target = $('.footer');
    var targetPos = target.offset().top;
    var winHeight = $(window).height();
    var scrollToElem = targetPos - winHeight - 400;

    var winScrollTop = $(this).scrollTop();

    var id = '';

    $('[data-post-id]').each(function() {

        id = id + $(this).attr('data-post-id') + ',';

    });

    if(winScrollTop > scrollToElem){

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

                    var singleGallery = $('.gallery .single-carousel');
                    singleGallery.lightGallery();
                    singleGallery.owlCarousel({
                        items: 3,
                        margin: 16,
                        lazyLoad: true,
                        nav: true,
                        autoplay:true,
                        autoplayTimeout:2000,
                        navText: ['<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                        '                            <path d="M13.0487 7.10149C13.4393 7.49201 13.4393 8.12518 13.0487 8.5157L6.68478 14.8797C6.29426 15.2702 5.66109 15.2702 5.27057 14.8797C4.88004 14.4891 4.88004 13.856 5.27057 13.4654L10.9274 7.80859L5.27057 2.15174C4.88004 1.76122 4.88004 1.12805 5.27057 0.737526C5.66109 0.347002 6.29426 0.347002 6.68478 0.737526L13.0487 7.10149ZM0.258301 6.80859L12.3416 6.80859V8.80859L0.258301 8.80859L0.258301 6.80859Z" fill="white"></path>\n' +
                        '                        </svg>', '<svg width="14" height="16" viewBox="0 0 14 16" fill="none" xmlns="http://www.w3.org/2000/svg">\n' +
                        '                            <path d="M1.14706 7.10149C0.756536 7.49201 0.756536 8.12518 1.14706 8.5157L7.51102 14.8797C7.90155 15.2702 8.53471 15.2702 8.92523 14.8797C9.31576 14.4891 9.31576 13.856 8.92523 13.4654L3.26838 7.80859L8.92523 2.15174C9.31576 1.76122 9.31576 1.12805 8.92523 0.737526C8.53471 0.347002 7.90155 0.347002 7.51102 0.737526L1.14706 7.10149ZM13.9375 6.80859L1.85417 6.80859V8.80859L13.9375 8.80859V6.80859Z" fill="white"></path>\n' +
                        '                        </svg>'],
                        navElement: 'a></a',
                        responsive: {
                            1024: {
                                items: 3
                            },
                            768: {
                                items: 3
                            },
                            0: {
                                items: 2
                            }
                        }
                    });
                }

                $('.recomend').append(data);

            },
        })
    }
});