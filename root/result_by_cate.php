<?php
	require_once("./post.php");

	$stmt = search_cate($_POST["p_cat"]);
?>

<?php foreach($stmt as $post): ?>
	<div>
		<li><?php echo $post['P_ID']; ?></li>
		<li><?php echo $post['P_TITLE']; ?></li>
		<li><?php echo $post['P_EYE']; ?></li>
	</div>
<?php endforeach;?>
