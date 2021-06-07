<!DOCTYPE html>
<html>
<head>
	<title>Access Google Maps API in PHP</title>
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<script type="text/javascript" src="js/googlemap.js"></script>
	<style type="text/css">
		.container {
			height: 450px;
		}
		#map {
			width: 100%;
			height: 100%;
			border: 1px solid blue;
		}
		#data, #allData {
			display: none;
		}
	</style>
</head>
<body>
	<div class="container">
		<center><h1>Access Google Maps API in PHP</h1></center>
		<?php 
			require 'education.php';
			$edu = new education;
			$coll = $edu->getCollegesBlankLatLng();
			$coll = json_encode($coll, true);
			echo '<div id="data">' . $coll . '</div>';

			$allData = $edu->getAllColleges();
			$allData = json_encode($allData, true);
			echo '<div id="allData">' . $allData . '</div>';			
		 ?>
		<div id="map"></div>
	</div>
</body>
<script async defer
    src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAGbkW319hmMjqSH418Vp76j2t3v4JPdNo&callback=loadMap">
</script>

</html>


<?php 
function getCoordinatesFromAdress($address) {
global $ln;
$response = array();
if (!empty($address)) {
if (defined('GOOGLE_MAP_API_KEY')) {
$endPoint = "https://maps.googleapis.com/maps/api/geocode/json?address=" . urlencode($address) . "&key=" . GOOGLE_MAP_API_KEY;
$gecode = file_get_contents($endPoint);
$decodeFormatted = json_decode($gecode);

if ($decodeFormatted->status == 'OK') {
$response['msg_code'] = 'CS0';
$response['msg'] = 'Success';
$response['data'] = $decodeFormatted->results[0]->geometry->location;
} else {
$response['msg_code'] = 'CS1';
$response['msg'] = 'Sorry No address found';
}
} else {
$response['msg_code'] = 'CS1';
$response['msg'] = 'Sorry No address found';
}
} else {
$response['msg_code'] = 'CS1';
$response['msg'] = 'Please provide address';
}

return $response;
}


 ?>

<!-- https://maps.googleapis.com/maps/api/geocode/json?address=201009&key=AIzaSyAGbkW319hmMjqSH418Vp76j2t3v4JPdNo -->
<!-- https://developers.google.com/maps/documentation/geocoding/overview -->