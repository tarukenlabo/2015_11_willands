$(function(){
	$("#cate_navi").css("display","none");
	
	//var flag = false;
	
	/*$('.cate_navi_button').click(function(){
		if(flag === false){
			$("#cate_navi").slideUp(1000);
			flag = true;
		}else{
			$("#cate_navi").slideDown(1000);
			flag = false;
		}
		
	});*/
	
	$('.cate_navi_button').click(function(){
		$("#cate_navi").slideToggle();
	});

});