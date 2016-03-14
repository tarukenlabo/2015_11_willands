<?php
	session_start();
	
	$_SESSION["post_data"] = $_POST;
	
	$u_id = $_SESSION['u_id'];
	$post_id = $_GET['p_id'];
	$user_id = $_SESSION['u_id'];
	
	require_once("./db_connect.php");
	require_once("./functions.php");
	require "ErrorHandling.php";
	require "ImageObj.php";


	$error = new ErrorHandling;
	$image_obj = new ImageObj;
	$e_message = 0;

	$db = new cls_db();
	$dbh = $db->db_connect();
	$dbh->query('SET NAMES utf8');
	
	$stmt=$dbh->prepare("SELECT CATE_NAME FROM cate WHERE CATE_ID = '".$_POST['cate']."'");
	$stmt->execute();
	
	foreach($stmt as $val){
		$cate_name = $val['CATE_NAME'];
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
	
	$count = count($args);
	
	if($count === 0){
		$posix = 35.67849;
		$posiy = 139.39178;
	}else{
		$posix = $args[0]['C_POSIX'];
		$posiy = $args[0]['C_POSIY'];		
	}
	
	
	$img_title = $_FILES['uPhoto']["name"];
	if(empty($img_title)){
		$get_img_sql = "SELECT P_EYE FROM post WHERE P_ID =".$post_id;
		$get_img = $dbh->prepare($get_img_sql);
		$get_img->execute();
		
		foreach($get_img as $val){
			$img_src = $val['P_EYE'];
		}
		
		$_SESSION['photo_path'] = $img_src;
	}else{
		//ファイルサイズ判定
		if( $error -> fileSizeDecision( (int)$_FILES["uPhoto"]["size"] ) ){
			$e_message[] = "アップロードできるファイルサイズの上限20Mを超えています。";
		}
		
		//ファイル拡張子判定
		if( $error -> fileExtendDecision( (int)$_FILES["uPhoto"]["name"] ) ){
			$e_message[] = "アップロードできるファイルの種類は画像のみです。";
		}
		
		//一つでもエラーがあればリダイレクト
		if( is_array( $e_message ) ){
			header( "Location: ./chek-in_map.php" );
		}
		
		//アップロード画像リネーム
		$image_name = $image_obj -> imageRename( $_FILES["uPhoto"]["name"],$user_id,$post_id );
		//TMPファイル移動
		$upload_file_path = $image_obj -> imageMove( $_FILES["uPhoto"]["tmp_name"], $image_name );
		
		$_SESSION['photo_path'] = $upload_file_path;
	}
?>

<!-- デザイン班のheader.phpと共通する<head>部分　ここから -->
<!DOCTYPE html>
<html lang="ja">
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" href="./css/style_oocss.css" type="text/css">
	<title>たるナビ -Tabi-Route Navigation-</title>
<!-- デザイン班のheader.phpと共通する<head>部分　ここまで -->

	<link rel="stylesheet" href="./css/lightbox.css">
	<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
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
	    
	    google.maps.event.addListener(map, 'dragstart', function() //◆地図が動いたらインフォウィンドウをクローズする。
		{
		infoWindow.close();
		});

	} 
	 
	window.onload = initialize;
</script>

</head>
<body>
	<?php include_once("analyticstracking.php") ?>
	<!-- デザイン班のheader.phpと共通する<body>部分　ここから -->
	<div id="container" class="align-center">
		<header>
			<div class="header_bar">
			</div>

			
			<div class="search">
				
				<form action="/" name="search" method="get" class="search_form">
				<dl class="search">
				<dt><input type="text" name="search" value="" placeholder="検索" /></dt>
				<dd><button><span></span></button></dd>
				</dl>
				</form>
				
				<img src="./img/sea.jpg">
				<div class="tarunavi_logo">
				<img src="./img/tarunavi_logo.png" >
				</div>
			</div>
		</header>
	<!-- デザイン班のheader.phpと共通する<body>部分　ここまで -->
<article class="skyblue">
	<div id="wrap">
		<div class="contents-title align-c ">
			<p class="article-title"><?php echo $_POST['title']; ?></p>
		</div>
			
		<div class="form-detail clearFix">
			<div class="post_img l-float large-photo white">
				<img src="<?php echo $img_src; ?>">
				<input type="file" name="uPhoto" value="写真選択">
			</div>

			<div class="form-detail2 r-float">
				<table>
					<tr>
						<th><p class="">投稿テーマ</p></th>
						<td><?php echo $cate_name; ?></td>
					</tr>
					
					<tr>
						<th><p class="">人数</p></th>
						<td><?php echo $_POST["peaple"]; ?>人</td>
					</tr>
					
					<tr>
						<th><p class="">金額</p></th>
						<td>￥<?php echo $_POST['price']; ?></td>
					</tr>
					
					<tr>
						<th><p class="">日数</p></th>
						<td><?php echo $_POST['sday']; ?>&nbsp～&nbsp<?php echo $_POST['fday']; ?></td>
					</tr>
				</table>
				<a href="#map_canvas"><button id="" class="">地図でルートを見る</button></a>
			</div>  <!--post_detail2-->
		<!-- デザインカンプに無いけど、あったほうが良い ここから-->
			<div class="clearFix align-center text-box">
				<p class="other-text ">記事全体コメント</p>
				<p><?php echo $_POST['comment']; ?><p>
			</div>
		<!-- デザインカンプに無いけど、あったほうが良い ここまで-->
		</div> <!--post_detail-->

			<div id="checkins" class="box-frame shadow white ">
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
						</div>
				<?php endforeach; ?>
			</div> <!--checkins-->

		<div id="map_canvas" class="map box-frame shadow white "></div>

		<button onClick="history.back()">戻る</button>
		<button onClick="location.href='./post_rough.php?p_id=<?php echo $post_id; ?>'">下書きを保存（非公開）</button>
		<button onClick="location.href='./post_release.php?p_id=<?php echo $post_id; ?>'">公開</button>
	</div> <!-- #wrap -->
</article>
<!-- デザイン班のfooter.phpと共通する部分　ここから -->
			<footer class="clearFix">
				<div class="fotter_logo l-float white">
					<img src="./img/tarunavi_logo.png" >
					
					<div class="r-float">
						<ul class="">
							<li class="l-float margin10"><a class="foot-text" href="#">たるナビトップ</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">ログイン</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">会員登録</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">利用規約</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">プライバシーポリシー</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">ご利用ガイド</a></li>
							<li class="l-float margin10"><a class="foot-text" href="#">お問い合わせ</a></li>
						</ul>
						<div class="foot-anime foot-anime2">
							<img src="./img/l_019.png" width="100">
						</div>
					</div>
					
				</div>
				
					
			</footer>
		</div>
	</body>	
</html>
<!-- デザイン班のfooter.phpと共通する部分　ここまで -->
