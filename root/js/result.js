$(function(){
	//カテゴリ操作
	$('.cate-link').click(function(){
		//カテゴリをテキストボックスへ
		var catText = $(this).text();
		$('#cate-box').val( catText );
		dataRegister();
		return false;
	});
	
	//データ操作
	
});

//データ操作関数

function dataRegister(){
	$.ajax({
		url: './regist.php',
		type: 'POST',
		cache: false,
		data: {
			'search_text': 'test',
		},
	}).done(function(data, textStatus, jqXHR){
		alert("success!");
		$(".ex").html(data);
	}).fail(function(data, textStatus, errorThrown){
		alert(textStatus); //エラー情報を表示
		console.log(errorThrown.message); //例外情報を表示
	});//.always(function(data, textStatus, returnedObject);
}