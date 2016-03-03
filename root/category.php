<?php
	require_once("./db_connect.php");
	
	function get_cate(){
		$db = new cls_db();
		$dbh = $db->db_connect();
		
		$dbh->query('SET NAMES utf8');
		
		$select = "SELECT * FROM cate";
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();
		
		foreach($stmt as $post):?>
			<li><?php echo $post['CATE_ID']."　".$post['CATE_NAME'] ?></li>
		<?php endforeach;
	}
	
	
	get_cate();