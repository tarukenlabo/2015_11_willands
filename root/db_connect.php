<?php

class cls_db{

	function db_connect(){

		if (!defined('DBN')){
			define('DBN','mysql:host=192.168.1.216;dbname=TARU_NAVI');
		}
		if (!defined('NAME')){
			define('NAME','taru_navi');
		}
		if (!defined('PASS')){
			define('PASS','@Pass2222');
		}

		$dbh = new PDO(DBN,NAME,PASS);

		return $dbh;
	}

}
