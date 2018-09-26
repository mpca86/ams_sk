<!DOCTYPE html>
<html lang="sk">
<head>

	<title>Sieť staníc AMS.sk</title>
	<meta name="description" content="Grafy pre AMS.sk">
	<meta name="author" content="Martin Šturcel">

	<meta charset="utf-8" />
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="mobile-web-app-capable" content="yes">
	<link rel="icon" sizes="192x192" href="./img/ams_square_medium.png">

	<link rel="shortcut icon" type="image/x-icon" href="./img/ams_square_medium.png" />

    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA==" crossorigin=""/>
    <script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js" integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA==" crossorigin=""></script>


</head>
<body>


<div id="mapid" style="width: 100%; height: 900px;"></div>
<script>

	var mymap = L.map('mapid').setView([49.505, 20.09], 8);

	L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
		maxZoom: 15,
		attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, ' +
			'<a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, ' +
			'Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
		id: 'mapbox.streets'
	}).addTo(mymap);

<?php
$conn = mysqli_connect('inetdb.nameserver.sk','mpca86','DikfowjefJiHeb6', 'pws_mpca86');

if (!$conn) {
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
    mysqli_set_charset($conn,"utf8");
    $sql = "SELECT * FROM ams_sk";
    $result = mysqli_query($conn, $sql);
    //var_dump($result);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "L.marker([" . $row["Lat"]. ", " . $row["Lng"] . "]).addTo(mymap)\r\n
                .bindPopup(\"<b> " . $row["Place"] . "</b><br />Teplota: " . $row["T"] . "°C<br />Vlhkosť: " . $row["H"] . "%<br />Atm. tlak: " . $row["P"] . " hPa<br />Rýchlosť vetra: " . $row["W"] . " m/s<br />Smer vetra: <img title='" . $row["B"] . "' src='https://sturcel.sk/martin/ams/img/pocasie/vietor/" . $row["B"] . ".png'</img><br />Čas merania: " . $row["DateTime"] . " \" )\r\n";
    }
}

mysqli_close($conn);
?>


//	.bindPopup("Mesto: <strong>Chopok</strong> (1998 m n. m.)<br />Teplota: <strong>7.0 &deg;C</strong><br />Oblačnosť: <strong>Zamračené</strong><br />Počasie: <strong>Hmla</strong><br />Rýchlosť vetra: <strong>4 m/s</strong> </p><p>Smer vetra: <img style=\"vertical-align:middle;\" alt=\"J\" title=\"J\" src=\"/img/pocasie/vietor/J.png\"><br />Čas merania:<strong> 27.08.2018 - 13:00</strong>");
	//L.marker([49.7, 20.2]).addTo(mymap)


	//var popup = L.popup();

	//function onMapClick(e) {
	//	popup
	//		.setLatLng(e.latlng)
	//		.setContent("You clicked the map at " + e.latlng.toString())
	//		.openOn(mymap);
	//}

	// mymap.on('click', onMapClick);

</script>



</body>
</html>
