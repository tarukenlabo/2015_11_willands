//DBへの接続

<?php
var_dump($_POST);

require "db_connect.php";


	$stmt = add_checkin($_POST["up_p_id"]);
	var_dump($stmt);

//INSERT INTO post_check_in(C_POSIX,C_POSIY) VALUES($,'$');

	//記事検索：チェックイン情報取得
	function add_checkin($p_id, $u_id){

			$db = new cls_db();
			$dbh = $db->db_connect();


		$dbh->query('SET NAMES utf8');
		
		$select = "INSERT INTO post_check_in "
					. "(C_ID, P_ID, U_ID, C_POSIX, C_POSIY, C_DATE, C_COMMENT) "
					. "VALUES ("
					. $_POST['C_ID'] . ", "
					. $_POST['P_ID'] . ", "
					. $_POST['U_ID'] . ", "
					. $_POST['C_POSIX'] . ", "
					. $_POST['C_POSIY'] . ", "
					. "\"" . $_POST['C_DATE'] . "\", "
					. "\"" . $_POST['C_COMMENT'] . "\", "
					. ");"
		
		$stmt = $dbh->prepare($select);
		$stmt->execute();

		var_dump($stmt);

		return $stmt;
		
	}
