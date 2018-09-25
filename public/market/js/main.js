$(document).ready(function () {
    $(".owl-carousel").owlCarousel({
        rtl:true,
        dots: true,
        margin: 10,
        loop: true,
        items: 4,
        nav: false,
        navText: ['<i class="fa fa-chevron-right" aria-hidden="true"></i>','<i class="fa fa-chevron-left" aria-hidden="true"></i>']
    });


    $(".gallery-img").click(function (){
        var x = $(this).attr("src");
        $(".main-pic").attr('src', x);
    });
});