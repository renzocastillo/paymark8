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
$(document).ready(function(){
  $('.multiple-carousel').slick({  
    dots: true,
    infinite: false,
    speed: 300,
    slidesToShow: 5,
    slidesToScroll: 5,
    autoplay: true,
    autoplaySpeed: 2000,
    responsive: [
      {
        breakpoint: 1024,
        settings: {
          slidesToShow: 3,
          slidesToScroll: 3,
          infinite: true,
          dots: true
        }
      },
      {
        breakpoint: 600,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 1,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});    

$(window).on('load',function(){
    $('#anuncio').modal('show');
});

