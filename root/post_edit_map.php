<?php
	require_once("./db_connect.php");
	
	require_once('./get_cate.php');
	$cate = array();
	$cate = get_cate();

	
	//session_start();
	//GETで取得予定
	$u_id = 1;
	$post_id = 2;
	
	$db = new cls_db();
	$dbh = $db->db_connect();
	
	$dbh->query('SET NAMES utf8');
	
	$get_posts = "SELECT * FROM post WHERE P_ID = '".$post_id."'";
	
	$stmt = $dbh->prepare($get_posts);
	$stmt->execute();
	
	foreach($stmt as $post){
		$title = $post['P_TITLE'];
		$img_src = $post['P_EYE'];
		$peaple = $post['P_PEAPLE'];
		$price = $post['P_PRICE'];
		$sday = $post['P_SDAY'];
		$fday = $post['P_FDAY'];
		$p_cate = $post['P_CAT'];
		$o_flg = $post['P_OFLAG'];
		$p_comment = $post['P_AWORD'];
	}
	
	$get_u_info = "SELECT * FROM u_auth WHERE U_ID = '".$u_id."'";
	$stmt = $dbh->prepare($get_u_info);
	$stmt->execute();
	
	foreach($stmt as $u_info){
		$u_name = $u_info['U_NAME'];
	}
		
		
	$get_posts = "SELECT * FROM post_check_in WHERE P_ID = '".$post_id."'";
	$posts = $dbh->prepare($get_posts);
	$posts->execute();

	$get_posts_map = "SELECT C_TITLE,C_POSIX,C_POSIY FROM post_check_in WHERE P_ID = '".$post_id."'";
	$posts_map = $dbh->prepare($get_posts_map);
	$posts_map->execute();

	$args = array();
	
	while($test = $posts_map->fetch(PDO::FETCH_ASSOC) ){
		$args[] = $test;
	}

	
	
	
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/post_style.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
	<script src="./js/edit_post.js"></script>
	<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false"></script>
	<script type="text/javascript">
	var center = new google.maps.LatLng(35.67849, 139.39178);
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
	 /*
	    var markers = [
	    ['公園1', 35.760191,140.061629,'kouen'],
	    ['公園2', 35.643033,139.860592,'kouen'],
	    ['公園3', 35.596286,140.141172,'kouen'],
	    ['温泉1', 35.805307,140.16651,'onsen1'],
	    ['温泉2',35.717602,139.980167,'onsen1'],
	    ['温泉3', 35.42295,139.89739,'onsen1'],
	    ['水族館1',36.333294,140.593817,'suizokukan'],
	    ['水族館2', 35.442851,139.644607,'suizokukan'],
	    ['水族館3', 35.728681,139.719765,'suizokukan'],
	    ];
	    */
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
	<div id="wrap">
		<div class="title">
		<form action="./post_confirm.php" method="post">
			<p>投稿タイトルを入力</p>
			<input type="text" name="title" value="<?php echo $title; ?>">
		</div>
		
		<div class="post_detail">
			<div class="post_img">
				<img src="<?php echo $img_src; ?>">
				
			</div>
			
			<div class="post_detail2">
				<table>
					<tr>
						<th>投稿者名</th>
						<td><?php echo $u_name; ?></td>
					</tr>
		
					<tr>
						<th>投稿テーマ</th>
						<td>
							<select name="cate">
								<?php foreach($cate as $val): 
									$cate_id = $val['CATE_ID'];
								?>
									<option value="<?php echo $cate_id; ?>" <?php if($cate_id === $p_cate){echo 'selected';} ?>><?php echo $val['CATE_NAME'];?></option>
								<?php endforeach; ?>
							</select>
						</td>
					</tr>
					
					<tr>
						<th>人数</th>
						<td><input type="number" name="peaple" value="<?php echo $peaple; ?>"></td>
					</tr>
					
					<tr>
						<th>金額</th>
						<td><input type="number" name="price" value="<?php echo $price; ?>"></td>
					</tr>
					
					<tr>
						<th>日数</th>
						<td><input type="date" name="sday" value="<?php echo $sday; ?>">&nbsp～&nbsp<input type="date" name="fday" value="<?php echo $fday; ?>"></td>
					</tr>
					
					<tr>
						<th>記事全体コメント</th>
						<td><textarea name="comment" cols="100" rows="10"><?php echo $p_comment; ?></textarea></td>
					</tr>

					
				</table>
			</div>
			<input id="post_edit_btn" type="submit" value="確認画面へ">
		</form>
			
			<div id="checkins">
				<?php foreach($posts as $checks):
					$c_id = $checks['C_ID'];
					$p_id = $checks['P_ID'];
				 ?>
						<div class="check_comment" id="<?php echo $c_id; ?>" style="border:1px solid black">
							<h3><?php echo $checks['C_TITLE']; ?></h3>
							<p><?php echo $checks['C_COMMENT']; ?></p>
													
													
							<?php
								$get_posts_photo = "SELECT * FROM post_photo WHERE C_ID = '".$c_id."' && P_ID = '".$p_id."'";
								$posts = $dbh->prepare($get_posts_photo );
								$posts->execute();
								
								foreach($posts as $photo): ?>
									<div class="photo"><img src="<?php echo $photo['C_PHOTO']; ?>"></div>
								<?php endforeach; ?>
						<button id="<?php echo $c_id; ?>" class="edit_button">編集</button>
						</div>
				<?php endforeach; ?>
			</div>
		</div>
		
		
	<div  id="map_canvas" style="width:90%;height:600px;"></div>
	</div>
	<script>
		var a = <?php echo $post_id; ?>;
		//document.write(a);
	</script>
</body>
</html>