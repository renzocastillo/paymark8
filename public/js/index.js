
$(window).on('load',function(){
  //$('#anuncio').modal('show');
});
$(document).ready(function(){
    $('#anuncio').modal('show');
    $( "#register_form" ).submit(function( event ) {
      $(this).prop('disabled', true);
    });
    $('.carousel').slick({
        arrows:false,
        autoplay: true,
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
  $('.multiple-carousel').slick({  
    dots: false,
    infinite: true,
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
          slidesToShow: 2,
          slidesToScroll: 1
        }
      }
      // You can unslick at a given breakpoint now by adding:
      // settings: "unslick"
      // instead of a settings object
    ]
  });
});
/* INICIA SECCIÓN DE LECTURA DEL VIDEO */
var video = document.getElementById("video");

var timeStarted = -1;
var timePlayed = 0;
var duration = 0;
var visto= 0;
// If video metadata is laoded get duration
if(video.readyState > 0)
  getDuration.call(video);
//If metadata not loaded, use event to get it
else
{
  video.addEventListener('loadedmetadata', getDuration);
}
// remember time user started the video
function videoStartedPlaying() {
  timeStarted = new Date().getTime()/1000;
}
function videoStoppedPlaying(event) {
  // Start time less then zero means stop event was fired vidout start event
  if(timeStarted>0) {
    var playedFor = new Date().getTime()/1000 - timeStarted;
    timeStarted = -1;
    // add the new ammount of seconds played
    timePlayed+=playedFor;
  }
  //document.getElementById("played").innerHTML = Math.round(timePlayed)+"";
  // Count as complete only if end of video was reached
  if(timePlayed>=Math.floor(duration) && event.type=="ended" && visto==0) {
    visto=1;
    video_visto();
  }
}
$('video').bind('play', function (e) {
  if(visto==0){
    visto=1;
    video_visto();
  }
});
function video_visto(){
  console.log("se ha visto el visto el video por completo");
    var video_id=video.dataset.id;
    console.log("En la BD este video tiene el id "+video_id);
    //var cms_users_id=video.dataset.user;
    var base_url=window.location.origin+'/';
    var url=window.location.href;
    if(url != base_url){
      console.log("se está usando un enlace de usuario. Se insertará una reproducción en la BD");
      //console.log(cms_users_id);
      //INICIAMOS AJAX PARA MANDAR REPRODUCCCION DEL VIDEO A LA DB
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        }
      });
      $.ajax({
        url:  window.location.href+'/add_reprod',
        method: 'post',
        data: {
            video_id: video_id
        },
        success: function(result){
            console.log(result);
        },
        error: function(err) {
          console.log(err.responseText);
        }
      });
    }else{
      console.log("Se ha visto el video sin usar un enlace de usuario. No se agregará la reproducción a la BD");
    }
}
function getDuration() {
  duration = video.duration;
  //document.getElementById("duration").appendChild(new Text(Math.round(duration)+""));
  console.log("Duration: ", duration);
}

video.addEventListener("play", videoStartedPlaying);
video.addEventListener("playing", videoStartedPlaying);

video.addEventListener("ended", videoStoppedPlaying);
video.addEventListener("pause", videoStoppedPlaying);

/* TERMINA SECCIÓN DE LECTURA DEL VIDEO */
/* INICIA SECCION DE VALIDAR EL REGISTRO */
$("#register_form").validate({
  rules: {
    email: {
      required:true,
      email: true,
      remote: {
        url: window.location.origin+'/check_email?email='+$( "#email" ).val(),
        type: "get"
      }
    },
    password: { 
      required: true,
      minlength: 6,
      maxlength: 10,
    }, 
    cfmPassword: { 
      equalTo: "#password",
      minlength: 6,
      maxlength: 10
    },
    terms:{
      required:true,
    }


  },
  messages:{
    password: { 
      required:"El password es requerido"
    },
    email:{
      remote:"Este email ya existe en nuestra plataforma. Por favor ingresa otro"
    },
    terms:{
      required:" Debes aceptar los términos para poder registrarte en la plataforma"
    }
  }
});
/* TERRMINA SECCIÓN DE VALIDAR EL REGISTRO */
/* INICIA SECCIÓN Javascript para efecto en titulos e imagenes. Detect request animation frame */
var scroll = window.requestAnimationFrame ||
             // IE Fallback
             function(callback){ window.setTimeout(callback, 1000/60)};
var elementsToShow = document.querySelectorAll('.show-on-scroll'); 

function loop() {

    Array.prototype.forEach.call(elementsToShow, function(element){
      if (isElementInViewport(element)) {
        element.classList.add('is-visible');
      } else {
        element.classList.remove('is-visible');
      }
    });

    scroll(loop);
}

// Call the loop for the first time
loop();

// Helper function from: http://stackoverflow.com/a/7557433/274826
function isElementInViewport(el) {
  // special bonus for those using jQuery
  if (typeof jQuery === "function" && el instanceof jQuery) {
    el = el[0];
  }
  var rect = el.getBoundingClientRect();
  return (
    (rect.top <= 0
      && rect.bottom >= 0)
    ||
    (rect.bottom >= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.top <= (window.innerHeight || document.documentElement.clientHeight))
    ||
    (rect.top >= 0 &&
      rect.bottom <= (window.innerHeight || document.documentElement.clientHeight))
  );
}