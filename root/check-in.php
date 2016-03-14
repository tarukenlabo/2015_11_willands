<!DOCTYPE html>
<html lang="ja">
	<head>
		<meta charset="UTF-8">
		<link rel="stylesheet" href="./style_oocss.css" type="text/css">
		<title>(★各ページタイトル入れてください)</title>
	<head>
	<body>
		
			<?php require 'header.php' ; ?>

			<nav>
				<ul>
					<li class="l-float clear-text">(★地図で選ぶ)</li>
					<li class="l-float clear-text">(★カテゴリーで選ぶ)</li>
					<li class="l-float clear-text">(★キーワードで選ぶ)</li>
				</ul>
			</nav>
			
	<article class="clearFix hadairo">
		<!-- 現在地情報を反映した地図の表示 -->
		<div class="box-frame shadow align_center white">
		<h1 class="contents-title">チェックイン</h1>
		<div class="map box-frame shadow"></div>
	
		
		
		<form method="POST" action="checkin_upload.php" enctype="multipart/form-data">
		<p class="contents-title">位置：

		<!-- 現在地情報を反映した緯度・経度の表示 -->
			<table class="position" border="1" cellspacing="0">
			<tr><th>緯度</th><td id="show_lat"></td></tr>
			<tr><th>経度</th><td id="show_lng"></td></tr>
			</table></p>


		<p class="contents-title">写真選択：<input type="file" name="uPhoto" value="写真選択"></p>
		
		
		<form action="./checkin_upload.php" method="POST" enctype="multipart/form-data">
		<p class="contents-title">タイトル：<input type="text" name="uTitle"></p>
		<p class="contents-title">コメント：<textarea name="comment"></textarea></p>
		<div>
			<input type="hidden" name="p_id" value="<?php echo $_GET['p_id'] ;?>">
			<input type="hidden" name="uLat" id="userLatitude">
			<input type="hidden" name="uLng" id="userLongitude">
			<p><input class="check_button" type="submit" value="登録"><input class="check_button" type="reset" value="リセット"></p>
		</div>
		</form>
		</form>
		</div>
		
	</article>
			
			<?php require 'footer.php' ; ?>
		</div><!--#wrap-->
	</body>	
</html>

	
<!DOCTYPE html>
<html lang="ja">
<head>
<meta charset="UTF-8">
<title>GMaps.jsでGeoLocationAPIを利用</title>
<script type="text/javascript" src="http://maps.google.com/maps/api/js"></script>
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js"></script>
<script type="text/javascript" src="./js/gmaps.js"></script>
<script type="text/javascript">
var map;
var uLat;
var uLng;
window.onload = function showMap () {
GMaps.geolocate({
		// GeoLocationAPIで位置情報の取得に成功した場合
		success: function(position) {
			uLat = position.coords.latitude;
			uLng = position.coords.longitude;
			showLatLng ( uLat, uLng );
			//postLatLng ( uLat, uLng );
			// class="map"に位置情報を反映した地図を表示
			map = new GMaps({
				div: '.map',
				lat: uLat,
				lng: uLng,
				zoom: 17
			});
			// マーカーとして現在地を表示
			map.addMarker({
				lat: uLat,
				lng: uLng,
				title: '現在地',
			});
			// 右クリックのコンテキストメニューで現在地を変更
			map.setContextMenu({
				control: 'map',
				options: [{
				title: '現在地を変更',
					name: 'current_position_here',
					action: function(e) {
					  this.removeMarkers(); // 既存のマーカーを消去
					  this.setCenter(e.latLng.lat(), e.latLng.lng()); // 地図の中心を変更
					  this.addMarker({
					    lat: e.latLng.lat(),
					    lng: e.latLng.lng(),
					    title: '現在地'
					  }); // 新たなマーカーを表示
					  showLatLng (e.latLng.lat(), e.latLng.lng()); // 新たな緯度･経度を表示
					  setGio(e.latLng.lat(), e.latLng.lng()); //Formに値セット
					}
				}]
			});
			setGio(uLat, uLng); //Formに値セット
		},
		// GeoLocationAPIで位置情報の取得に失敗した場合
		error: function(error) {
		  alert('位置情報の取得に失敗しました: '+error.message);
		},
		// GeoLocationAPIが利用できない場合
		not_supported: function() {
		  alert("恐れ入りますが、ご利用のブラウザでは現在地の表示ができません");
		},
		// [オプション] 常に何かをさせたい場合
		always: function() {
		  alert("現在地を表示します");
		}
	});
		
}
// 引数をもとに緯度・経度の値を表示
function showLatLng ( lat, lng ) {
	document.getElementById("show_lat").innerHTML = lat;
	document.getElementById("show_lng").innerHTML = lng;
}
/*function postLatLng ( lat, lng ) {
	$("input").val("userLatitude") = lat;
	$("input").val("userLongitude") = lng;
}*/

//Formに情報セット
function setGio( lat,lng){
	$('#userLatitude').val( lat );
	$('#userLongitude').val( lng );
}

</script>
<style>
	.map {
		width: 95%;
		height:500px;
	}
	
	.position{
	margin-left : 30px;
	margin-bottom : 10px;
	margin-top : 20px;
	color :#222;
}
</style>
</head>

</html>


