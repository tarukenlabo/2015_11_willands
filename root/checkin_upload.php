//DBへの接続

<?php
var_dump($_POST);

require "db_connect.php";

$db = new cls_db;

$dbh = $db -> db_connect();

var_dump($_dbh);
//DBへの接続　ここまで
