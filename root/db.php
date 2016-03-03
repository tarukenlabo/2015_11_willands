<?php
//	$db = mysql_connect('localhost', 'root', '', 'loginpage') or die(mysql_connect_error());
//	mysql_set_charset($db, 'utf8');
/* データベースの接続設定 */
$server = "192.168.1.216";
$user = "taru_navi";
$password = "@Pass2222";
$dbname = "TARU_NAVI";

/* データベースに接続 */
$conn = mysql_connect($server, $user, $password);
mysql_select_db($dbname);

// $dsn = "mysql:host=127.0.0.1;port=3307;dbname=TARU_NAVI";

// $dbh = new PDO( $dsn,$user,$password );
// var_dump( $dbh );

?>
