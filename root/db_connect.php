<?php

class cls_db{

	function db_connect(){

		if (!defined('DBN')){
			define('DBN','mysql:host=localhost;dbname=taru_navi');
		}
		if (!defined('NAME')){
			define('NAME','root');
		}
		if (!defined('PASS')){
			define('PASS','');
		}

		$dbh = new PDO(DBN,NAME,PASS);

		return $dbh;
	}

}
