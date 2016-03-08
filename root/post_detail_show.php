<?php
	//header("Content-type:text/plain;charset=UTF-8");
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	$select_id = h($_POST['id']);
	
	$stmt=$dbh->prepare("SELECT C_TITLE,C_COMMENT FROM post_check_in WHERE C_ID = ?");
	$stmt->execute(array($select_id));
	$dbh=null;
	
?>

<?php foreach($stmt as $check): ?>
<div id="pf">
	<h3>タイトル</h3>
		<input id="title" type="text" value="<?php echo $check['C_TITLE']; ?>" name="c_title">
	<h3>コメント</h3>
		<textarea id="c_comment" name="c_comment" cols="50" rows="7"><?php echo $check['C_COMMENT']; ?></textarea>
	<button class="del" id="<?php echo $select_id; ?>">削除</button>
	<button class="edit" id="<?php echo $select_id; ?>">更新</button>
</div>
<?php endforeach; ?>	