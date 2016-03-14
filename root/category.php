<style>
a {
	text-decoration:none;
	display:block;
	font-size:20px;
	line-height:25px;
}
</style>
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
			<a href="./result.php?cate=<?php echo $post['CATE_ID']; ?>"><li class="cate"><?php echo $post['CATE_NAME'] ?></li></a>
		<?php endforeach;
	}
	
	
	//get_cate();