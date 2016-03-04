<?php
	require_once("./db_connect.php");
	
	function get_img(){
		$db = new cls_db();
		$dbh = $db->db_connect();
		
		$dbh->query('SET NAMES utf8');
		
		$show_img = "SELECT P_ID,P_EYE FROM post";
		
		$stmt = $dbh->prepare($show_img);
		$stmt->execute();
		
		foreach($stmt as $val): ?>
			<li><?php echo $val['P_ID']."=".$val['P_EYE']; ?></li>
		<?php endforeach;
	}
	
	
	get_img();