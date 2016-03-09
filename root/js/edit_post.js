$(function(){

	//lightboxの設定
	$(document).on('click','.edit_button',function(event){
		var target=$(event.target);
		var edit_id = target.attr('id');
		$('#wrap').after('<div class="modal_wrap"><div class="modal_box"><p><span id="close">&times;</span></p><div class="modal_content"></div></div></div>');

		$.ajax({
			type:'POST',
			url:'./post_detail_show.php',
			data:{
				id:edit_id
			},
			success:function(data){
				$('.modal_content').html(data);
			}
		});
		
		$('#close').click(function(){
			$('.modal_wrap').fadeOut(500,function(){
				$(this).remove();
			});
		});
		
		
		
		//削除設定
		$(document).on('click','.del',function(event){
			var target=$(event.target);
			var del_id=target.attr('id');
			
			$.ajax({
				type:'POST',
				url:'./post_delete.php',
				data:{
					id:del_id
				},
				success:function(){
					$('.modal_wrap').fadeOut(500,function(){
						$(this).remove();
						$('#checkins #'+del_id).fadeOut();
					});
					
				}
			});
		});
		
		
		
		//更新設定
		$(document).on('click','.edit',function(event){
			var target=$(event.target);
			var edit_id=target.attr('id');
			
			$.ajax({
				type:'POST',
				url:'./checkin_edit.php',
				data:{
					id:edit_id,
					title:$('#title').val(),
					comment:$('#c_comment').val()
				},
				success:function(){
					$('.modal_wrap').fadeOut(500,function(){
						$(this).remove();
						location.reload();
					});
				}
			
			});
		
		});
		
	});
	
	/*
	var h = Math.max.apply( null, [document.body.clientHeight , document.body.scrollHeight, document.documentElement.scrollHeight, document.documentElement.clientHeight] );
	var result = h - 500 ;
	$('#post_edit_btn').css({'position':'absolute','bottom':result + 'px'});
	*/


});