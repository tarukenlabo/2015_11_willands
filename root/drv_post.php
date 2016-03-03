<?php
	require_once("./post.php");

?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<title>ドライバ　記事検索</title>
</head>
<body>
	<h1>【ドライバ】記事検索</h1>
	<h2>検索条件</h2>
	<form method="post" action="drv_post.php">
	  <table>
	    <caption>テスト入力</caption>
    	<tr>
	      <td>記事ID：（p_id）</td>
	      <td><input type="text" size="30" name="p_id"></td>
	    </tr>
	    <tr>
	      <td>カテゴリ値（数字）：</td>
	      <td><input type="text" size="30" name="p_cat"></td>
	    </tr>
	    <tr>
	      <td>キーワード（文字部分一致）：</td>
	      <td><input type="text" size="30" name="keyword"></td>
	    </tr>
    	<tr>
	      <td>チェックイン（c_id）：</td>
	      <td><input type="text" size="30" name="c_id"></td>
	    </tr>
    	<tr>
	      <td>ユーザーコメント一覧取得：（p_id）</td>
	      <td><input type="text" size="30" name="up_p_id"></td>
	    </tr>


	  </table>

	  <div><input type="submit" value=" 送 信 "></div>
	</form>

	<h2>検索結果</h2>

	<h3>ユーザーコメント一覧取得</h3>
	<?php
		$stmt = search_up_comment($_POST["up_p_id"]);
		var_dump($stmt);
	?>
	<?php foreach($stmt as $post3): ?>
		<li><?php echo $post3['P_ID']." ". $post3['U_ID']." ".$post3['UP_COMMENT']; ?></li>
	<?php endforeach;?>



	<h3>記事検索　ID指定</h3>
	<?php
		$post = search_id($_POST["p_id"]);
		echo $post['P_ID'] . " " . $post['P_TITLE'];
	?>


	<h3>記事検索　カテゴリ指定</h3>
	<?php
		$stmt = search_cate($_POST["p_cat"]);
	?>
	<?php foreach($stmt as $post2): ?>
		<li><?php echo $post2['P_ID']."　".$post2['P_TITLE']; ?></li>
	<?php endforeach;?>


	<h3>記事検索　キーワード指定</h3>
	<?php
		$stmt = search_keyword($_POST["keyword"]);
	?>
	<?php foreach($stmt as $post2): ?>
		<li><?php echo $post2['P_ID']."　".$post2['P_TITLE']; ?></li>
	<?php endforeach;?>


	<h3>記事検索　チェックイン一覧</h3>
	<?php
		$stmt = search_checkin($_POST["c_id"]);
	?>
	<?php foreach($stmt as $post3): ?>
		<li><?php echo $post3['C_ID']."　". $post3['P_ID']."　".$post3['C_POSIX']."　".$post3['C_POSIY']."　".$post3['C_PHOTO']; ?></li>
	<?php endforeach;?>



</body>
</html>
