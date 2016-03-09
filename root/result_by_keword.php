<?php
	require_once("./post.php");

	echo "aaa";

	$stmt = search_keyword($_POST["keyword"]);

	echo "bbb";

?>

<?php foreach($stmt as $post): ?>
	<div>
		<li><?php echo $post['P_ID']; ?></li>
		<li><?php echo $post['P_TITLE']; ?></li>
		<li><?php echo $post['P_EYE']; ?></li>
	</div>

<?php endforeach;?>
