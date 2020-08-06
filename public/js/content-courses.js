$(document).ready(function () {
    console.log('Holaaaaa platanito');
    $('.linkvid').on({
        'click': function(e){
            e.preventDefault();
            $('#source-video').attr('src',$(this).attr('href'));
            $('#video')[0].load();
            console.log("click");
        }
    });
})