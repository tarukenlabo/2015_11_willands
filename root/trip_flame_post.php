<?php
	require_once("./db_connect.php");
	require_once("./functions.php");
	
	//�Z�b�V�����J�n
	session_start();
	
	//�f�[�^�x�[�X�ɓo�^������̂��T�j�^�C�W���O���ϐ��Ɋi�[
	$u_id = h($_SESSION['u_id']);
	$cate =h($_POST["cate"]);
	$title = h($_POST["o_title"]);
	$sday = h($_POST["start_date"]);
	
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	//���s�̂�����i��g�j�̓o�^
	$sql = "INSERT INTO post(U_ID,P_CAT,P_TITLE,P_SDAY) VALUES(:u_id,:cate,:title,:sday)";
	$stmt = $dbh->prepare($sql);
	$stmt->execute(array(
		'u_id'=>$u_id,
		'cate'=>$cate,
		'title'=>$title,
		'sday'=>$sday
	));
	
