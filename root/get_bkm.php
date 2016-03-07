<?php
	require_once("./db_connect.php");
	
	function get_u_id($u_id){
		$db = new cls_db();
		$dbh = $db->db_connect();
		
		$dbh->query('SET NAMES utf8');
		
		$get_bkm = "SELECT P_ID FROM bookmark WHERE U_ID = ".$u_id;
		
		$stmt = $dbh->prepare($get_bkm);
		$stmt->execute();
		
		foreach($stmt as $val){
			$bkm_p_id[]= $val['P_ID'];
		}

		foreach($bkm_p_id as $val){
			$show_bkm = "SELECT P_TITLE FROM post WHERE P_ID =".$val;
			$stmt = $dbh->prepare($show_bkm);
			$stmt->execute();
			
			foreach($stmt as $title):?>
				<li><?php echo $title['P_TITLE']; ?></li>
			<?php endforeach; 
		}
	}
	
	get_u_id(1);
