$(function(){

	
	$('#search_by_keword').click(function(){

		var keyword = "桜　花"


		$.ajax({
			type:'POST',
			url:'./result_by_keyword.php',
			data:{
				keyword:keyword
			},
			success:function(data){
				$('.result_list').html(data);
			},
			error:function(data){
				$('.result_list').text('記事の検索に失敗しました');
			}

		});
	});

	$('#search_by_cate').click(function(){

		var p_cat = 1


		$.ajax({
			type:'POST',
			url:'./result_by_cate.php',
			data:{
				p_cat:p_cat
			},
			success:function(data){
				$('.result_list').html(data);
			},
			error:function(data){
				$('.result_list').text('記事の検索に失敗しました');
			}

		});
	});


});