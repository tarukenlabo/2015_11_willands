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
