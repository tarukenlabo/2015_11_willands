<?php
	session_start();

	require_once("./post.php");



?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>result.php</title>
    <script src="http://code.jquery.com/jquery-1.6.2.min.js"></script>
</head>
<body>

	<div>
		<h1>たるナビ</h1>

	</div>

	<div>

		<div>
<!--
検索条件
-->
			<div>
				<p>場所</p>
			</div>
			<div>
				<p>カテゴリ</p>
			</div>

			<div>
				<p>キーワード</p>

			</div>

		</div>
		
		<div>
<!--
写真一覧
-->
		<?php echo "111";?>

		<script>
		$(document).ready(function() 
		{
		
			var keyword = "桜　花"
		
			$.ajax({
				type:'POST',
				url:'./result_by_keword.php',
				data:{
					keyword:keyword
				},
				success:function(data){
					$('.modal_content').html(data);
				}
			});
		});
		</script>

		<?php echo "222";?>

		</div>

		<div>
<!--
地図指定
-->
		</div>
	
	</div>

</body>
</html>
