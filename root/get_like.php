<?php
	require_once("./dbh_yoneda.php");
	
	function get_like($p_id){
		$db = new cls_db();
		$dbh = $db->db_connect();
		
		$dbh->query('SET NAMES utf8');
		
		$get_like = "SELECT P_COUNT FROM post_like WHERE P_ID = ".$p_id;
		
		$stmt = $dbh->prepare($get_like);
		$stmt->execute();
		
		
		foreach($stmt as $val):?>
			<li><?php echo $val['P_COUNT']; ?></li>
		<?php endforeach;
	}

	get_like(3);
