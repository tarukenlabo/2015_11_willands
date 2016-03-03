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
	      <td>ユーザーID：</td>
	      <td><input type="text" size="30" name="p_id"></td>
	    </tr>
	    <tr>
	      <td>カテゴリ値</td>
	      <td><input type="text" size="30" name="p_cat"></td>
	    </tr>
	    <tr>
	      <td class="keyword">キーワード：</td>
	      <td><input type="text" size="30" name="keyword"></td>
	    </tr>
	  </table>

	  <div><input type="submit" value=" 送 信 "></div>
	</form>

	<h2>検索結果</h2>
	<h3>記事検索　ID指定</h3>
	<?php
		$post = search_id($_POST["p_id"]);
		echo $post['P_ID'] . " " . $post['P_TITLE'];
	?>


	<h3>記事検索　カテゴリ指定</h3>
	<?php
		$stmt = search_cate($_POST["p_cat"]);
		$var_dump = $stmt;
	?>
	<?php foreach($stmt as $post2): ?>
		<li><?php echo $post2['P_ID']."　".$post2['P_TITLE']; ?></li>
	<?php endforeach;?>


	<h3>記事検索　キーワード指定</h3>
	<?php
		$stmt = search_keyword($_POST["keyword"]);
		$var_dump = $stmt;
	?>
	<?php foreach($stmt as $post2): ?>
		<li><?php echo $post2['P_ID']."　".$post2['P_TITLE']; ?></li>
	<?php endforeach;?>

</body>
</html>
