$(document).ready(function(){
	$('#ajax-fevorite').click(function(){
		
		if($('#ajax-fevorite').attr('data-courseadd')=='true'){
			$('#ajax-fevorite').attr('data-courseadd','false')
			$('#ajax-fevorite').css('color','#333')
			$('.addad-to-favorite').text('Removed in Favorite');
			$('.addad-to-favorite').show().fadeOut(1800);;
		}
		else 
		{
			$('#ajax-fevorite').attr('data-courseadd','true')
			$('#ajax-fevorite').css('color','goldenrod')
			$('.addad-to-favorite').text('Added in Favorite');
			$('.addad-to-favorite').show().fadeOut(1800);;
		}
		
		var id = $('#ajax-fevorite').attr('data-courseid')
		var token = $("meta[name=csrf-token]").attr("content");  
		$.ajax({
			url:'/admin/courses/ajaxfavoriteadd',
			data:{course_id:id,'_token':token},
			type:"POST",
			success:function(data){
				
			}
		})
	})
});