(function( $ ) {

    $('.fadeOut').owlCarousel({
        items: 1,
        animateOut: 'fadeOut',
        nav: true,
        loop: true,
        margin: 10,
    });	

    const total = $('.box-image img').length;
    if ( total > 2 ) {
                    
        // Klik Dot 
        $('.owl-dot').click(function(){
            const click = $('.owl-dot').index(this) + 1;

            console.log(click);

            imgClick0 = document.querySelectorAll('.box-image img')[0].src;
            imgClick1 = document.querySelectorAll('.box-image img')[1].src;
            imgClick2 = document.querySelectorAll('.box-image img')[2].src;
            imgClick3 = document.querySelectorAll('.box-image img')[3].src;

            let imgLeft = '';
            let imgRight = '';

            if (click == 1) {
                imgLeft = imgClick1;
                imgRight = imgClick3;
            } else if ( click == 2 ) {
                imgLeft = imgClick2;
                imgRight = imgClick1;
            } else if ( click == 3 ) {
                imgLeft = imgClick0;
                imgRight = imgClick2;
            }

            $('.image-left').css('background-image', 'url(' + imgLeft + ')');
            $('.image-right').css('background-image', 'url(' + imgRight + ')');
        });

        const gambar1 = document.querySelectorAll('.box-image img')[1];
        const gambar2 = document.querySelectorAll('.box-image img')[3];

        $('.image-left').css('background-image', 'url(' + gambar1.src + ')');
        $('.image-right').css('background-image', 'url(' + gambar2.src + ')');

        img0 = document.querySelectorAll('.box-image img')[0].src;
        img1 = document.querySelectorAll('.box-image img')[1].src;
        img2 = document.querySelectorAll('.box-image img')[2].src;
        img3 = document.querySelectorAll('.box-image img')[3].src;

        $(".owl-prev").click(function(){
            let bkLeft = $('.image-left').css('background-image');
            bkLeft = bkLeft.replace('url(','').replace(')','').replace(/\"/gi, "");

            let bkRight = $('.image-right').css('background-image');
            bkRight = bkRight.replace('url(','').replace(')','').replace(/\"/gi, "");

            if ( bkLeft == img0 ) {
                gambarLeft = img2;
            } else if (  bkLeft == img1) {
                gambarLeft = img0;
            } else if (  bkLeft == img2 ) {
                gambarLeft = img1;
            } else {
                gambarLeft = '';
            }

            if ( bkRight == img0 ) {
                gambarRight = img2;
            } else if (  bkRight == img1) {
                gambarRight = img0;
            } else if (  bkRight == img2 ) {
                gambarRight = img1;
            } else {
                gambarRight = '';
            }

            $('.image-left').css('background-image', 'url(' + gambarLeft + ')');
            $('.image-right').css('background-image', 'url(' + gambarRight + ')');
        });

        $(".owl-next").click(function(){
            let bkLeft = $('.image-left').css('background-image');
            bkLeft = bkLeft.replace('url(','').replace(')','').replace(/\"/gi, "");

            let bkRight = $('.image-right').css('background-image');
            bkRight = bkRight.replace('url(','').replace(')','').replace(/\"/gi, "");

            if ( bkLeft == img0 ) {
                gambarLeft = img1;
            } else if (  bkLeft == img1) {
                gambarLeft = img2;
            } else if (  bkLeft == img2 ) {
                gambarLeft = img3;
            } else {
                gambarLeft = '';
            }

            if ( bkRight == img0 ) {
                gambarRight = img1;
            } else if (  bkRight == img1) {
                gambarRight = img2;
            } else if (  bkRight == img2 ) {
                gambarRight = img3;
            } else {
                gambarRight = '';
            }

            $('.image-left').css('background-image', 'url(' + gambarLeft + ')');
            $('.image-right').css('background-image', 'url(' + gambarRight + ')');
        });	
    }

})( jQuery );