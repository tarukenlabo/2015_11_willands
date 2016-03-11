<?php
	require_once("./db_connect.php");
	require_once("./functions.php");

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');

	$p_id = $_GET['P_ID'];
	//しおり内容取得
	$get_post = "SELECT * FROM post WHERE P_ID = ".$p_id;
	$stmt = $dbh->prepare($get_post);
	$stmt->execute();
	
	//しおり内容を変数に格納
	foreach($stmt as $post){
		$title = $post['P_TITLE'];
		$img_src = $post['P_EYE'];
		$peaple = $post['P_PEAPLE'];
		$price = $post['P_PRICE'];
		$sday = $post['P_SDAY'];
		$fday = $post['P_FDAY'];
		$p_cate = $post['P_CAT'];
		$p_comment = $post['P_AWORD'];
		$u_id = $post['U_ID'];
	}
	
	//ユーザーネーム取得
	$get_u_name = "SELECT U_NAME FROM u_auth WHERE U_ID =".$u_id;
	$uName = $dbh->prepare($get_u_name);
	$uName->execute();
	
	$userName = "名前未設定";
	
	foreach($uName as $name){
		$userName = $name['U_NAME'];
	}
	
	//カテゴリ名取得
	$get_cate = "SELECT CATE_NAME FROM cate WHERE CATE_ID =".$p_cate;
	$getCate = $dbh->prepare($get_cate);
	$getCate->execute();
	
	foreach($getCate as $cname){
		$cateName = $cname['CATE_NAME'];
	}
	
	//都度投稿取得
	$get_checkin = "SELECT * FROM post_check_in WHERE P_ID =".$p_id."&& U_ID = ".$u_id;
	$get_checks = $dbh->prepare($get_checkin);
	$get_checks->execute();
	

	//位置情報取得
	$get_posts_map = "SELECT C_TITLE,C_POSIX,C_POSIY FROM post_check_in WHERE P_ID = '".$p_id."'";
	$posts_map = $dbh->prepare($get_posts_map);
	$posts_map->execute();

	$args = array();
	
	while($test = $posts_map->fetch(PDO::FETCH_ASSOC) ){
		$args[] = $test;
	}

	$count = count($args);

	
	if($count === 0){
		$posix = 35.67849;
		$posiy = 139.39178;
	}else{
		$posix = $args[0]['C_POSIX'];
		$posiy = $args[0]['C_POSIY'];		
	}

	//コメント取得
	$get_comment = "SELECT u_auth.U_NAME,user_post_comment.P_ID,user_post_comment.UP_COMMENT FROM user_post_comment JOIN u_auth ON user_post_comment.U_ID = u_auth.U_ID WHERE P_ID =".$p_id;
	$gcome = $dbh->prepare($get_comment);
	$gcome->execute();


?>
<!DOCTYPE html>
<html>
	<head>
	<link rel="stylesheet" href="./css/post_style.css">
		<title>アーティクル</title>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	//var center = new google.maps.LatLng(35.67849, 139.39178);
	var center = new google.maps.LatLng(<?php echo $posix; ?>, <?php echo $posiy; ?>);
	var zoom = 8;
	var mapTypeId = google.maps.MapTypeId.ROADMAP
	</script>
	<script type="text/javascript">
	var marker;
	var defmarker;
	var markers = [];
	var infoWindow = new google.maps.InfoWindow();
	 
	function initialize()
	{
	 
	    var myOptions =
	    {
	    zoom: zoom,
	    center: center,
	    mapTypeId: mapTypeId
	    }
	    var map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
	    var markers = [
	    	<?php foreach($args as $val): ?>
	    		["<?php echo $val["C_TITLE"]; ?>",<?php echo $val["C_POSIX"]; ?>,<?php echo $val["C_POSIY"]; ?>,'kouen'],
	    	<?php endforeach; ?>
	    ];
		
	    for (var i = 0; i < markers.length; i++)
	    {
	    var marker = markers[i];
	 
	    var name = marker[0];
	    var latlng = new google.maps.LatLng(marker[1], marker[2]);
	 
	    var category =  marker[3];
	    var html = '<div style="height: 100px; width: 200px"><b>'+name+'</b>'  ;
	 
	    createMarker(latlng,html,map,category,name)
	    }
	 
	}
	 
	function createMarker(latlng,html,map,category,name)
	{
	    var iconOffset = new google.maps.Point(34, 34);
	    var iconPosition = new google.maps.Point(0, 0);
	    var iconSize = new google.maps.Size(34, 34);
	    var iconShadowSize = new google.maps.Size(37, 34);
	 
	    var kouenUrl = "http://maps.google.co.jp/mapfiles/ms/icons/tree.png";
	    var kouenShadowUrl = "http://maps.google.co.jp/mapfiles/ms/icons/tree.shadow.png";
	    var kouenIcon = new google.maps.MarkerImage(kouenUrl, iconSize, iconPosition, iconOffset);
	    var kouenShadow = new google.maps.MarkerImage(kouenShadowUrl, iconShadowSize, iconPosition, iconOffset);
	 
	    var onsenUrl = "http://maps.google.co.jp/mapfiles/ms/icons/hotsprings.png";
	    var onsenShadowUrl = "http://maps.google.co.jp/mapfiles/ms/icons/hotsprings.shadow.png";
	    var onsenIcon = new google.maps.MarkerImage(onsenUrl, iconSize, iconPosition, iconOffset);
	    var onsenShadow = new google.maps.MarkerImage(onsenShadowUrl, iconShadowSize, iconPosition, iconOffset);
	 
	    var suizokukanUrl = "http://maps.google.co.jp/mapfiles/ms/icons/fishing.png";
	    var suizokukanShadowUrl = "http://maps.google.co.jp/mapfiles/ms/icons/fishing.shadow.png";
	    var suizokukanIcon = new google.maps.MarkerImage(suizokukanUrl, iconSize, iconPosition, iconOffset);
	    var suizokukanShadow = new google.maps.MarkerImage(suizokukanShadowUrl, iconShadowSize, iconPosition, iconOffset);
	 
	    var customIcons =
	    {
	    kouen: {icon:kouenIcon,shadow:kouenShadow},
	    onsen: {icon:onsenIcon,shadow:onsenShadow},
	    suizokukan: {icon:suizokukanIcon,shadow:suizokukanShadow}
	    };
	 
	    var icon = customIcons[category] || {};
	 
	    var marker = new google.maps.Marker(
	    {
	    map: map,
	    position: latlng,
	    icon: icon.icon,
	    shadow: icon.shadow,
	    title: name
	    });
	 
	    google.maps.event.addListener(marker, 'click', function()
	    {
	             infoWindow.setContent(html);
	             infoWindow.open(map,marker);
	             map.panTo( latlng);
	    });
	} 
	 
	window.onload = initialize;
	</script>

	</head>
	<body>
		<h1>タルナビ</h1>
		<h2><?php echo $title; ?></h2>
		<div class="show_img">
			<img src="<?php echo $img_src; ?>">
		</div>
		<table>
			<tr>
				<th>投稿者名</th>
				<td><?php echo $userName; ?></td>
			</tr>
			
			<tr>
				<th>投稿テーマ</th>
				<td><?php echo $cateName; ?></td>
			</tr>
			
			<tr>
				<th>人数</th>
				<td><?php echo $peaple; ?>人</td>
			</tr>
			
			<tr>
				<th>金額</th>
				<td><?php echo $price; ?>円</td>
			</tr>

			<tr>
				<th>日数</th>
				<td><?php echo $sday; ?>～<?php echo $fday; ?></td>
			</tr>
		<table>
		
		
		<button class="bkm" onClick="location.href='./bkm.php?p_id=<?php echo $p_id; ?>'">お気に入り</button>
		
		
		<div class="check">
			<?php foreach($get_checks as $check): ?>
				<div class="checkins" style="border: 1px solid black">
					<h3><?php echo $check['C_TITLE']; ?></h3>
					<div class="check_comment">
						<?php echo $check["C_COMMENT"]; ?>
					</div>
					<div class="check_img">
						<?php
							//都度投稿写真取得
							$get_posts_photo = "SELECT * FROM post_photo WHERE C_ID = '".$check['C_ID']."' && P_ID = '".$p_id."'";
							$post_photo = $dbh->prepare($get_posts_photo );
							$post_photo->execute();
						
						foreach($post_photo as $val): ?>
							<img src="<?php echo $val["C_PHOTO"]; ?>">
						<?php endforeach; ?>
					</div>

				</div>
			<?php endforeach; ?>
		</div>
		<div  id="map_canvas" style="width:70%;height:600px;margin:0 auto;"></div>
		
		<div class="comments">
			<p>記事コメント</p>
			<?php foreach($gcome as $come): ?>
				<div class="come">
					<table border="1">
						<tr>
							<th><?php echo $come["U_NAME"]; ?></th>
							<td><?php echo $come["UP_COMMENT"]; ?></td>
						</tr>
					</table>
				</div>
			<?php endforeach; ?>
		</div>

		<a href="./comment-form.php?p_id=<?php echo $p_id; ?>"><p>コメントを投稿する</p></a>
	</body>
</html>