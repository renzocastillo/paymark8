$(document).ready(function(){
    $('.carousel').slick({
        arrows:true,
        infinite: true,
        speed: 300,
        slidesToShow: 1,
        responsive: [
            {
              breakpoint: 1024,
              settings: {
                dots:true,
                arrows:false
              }
            }
        ]
    });
   /* $('body').scroll(function() { 
   		$('#anuncio').css('top', $(this).scrollTop());
	});*/
});

$(window).on('load',function(){
    $('#anuncio').modal('show');
});

