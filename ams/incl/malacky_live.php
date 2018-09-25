<?php

$file_clientraw = file_get_contents("https://www.pocasienazahori.eu/wp-content/WLrealtime.htm"); // change this line if realtime.txt is at another location
$data_clientraw = explode("|", $file_clientraw);

$date = $data_clientraw[0]; //date (always dd.mm.yy)
$time = $data_clientraw[1]; //time(always hh:mm)
$temp = $data_clientraw[2]; //outside temperature
$hum = $data_clientraw[3]; //relative humidity
$dew = $data_clientraw[4]; //Dewpoint
$wspeed = $data_clientraw[5]; //wind speed (average)
$wlatest = $data_clientraw[6]; //latest wind speed reading
$bearing = $data_clientraw[7]; //wind bearing (degrees)
$rrate = $data_clientraw[8]; //current rain rate (per hour)
$rfall = $data_clientraw[9]; //rain today
$press = $data_clientraw[10]; //barometer
$currentwdir = $data_clientraw[11]; //current wind direction (compass point)
$beaufort = $data_clientraw[12]; //wind speed beaufort
$windunit = $data_clientraw[13]; //wind units - m/s, mph, km/h, kts
$tempunit = $data_clientraw[14]; //temperature units - degree C, degree F
$pressunit = $data_clientraw[15]; //pressure units - MB, hPa, in
$rainunit = $data_clientraw[16]; //rain units - mm, in
$windrun = $data_clientraw[17]; //wind run (today)
$presstrendval = $data_clientraw[18]; //pressure trend value
$rmonth = $data_clientraw[19]; //monthly rainfall
$ryear = $data_clientraw[20]; //yearly rainfall
$rfallY = $data_clientraw[21]; //yesterday's rainfall
$intemp = $data_clientraw[22]; //inside temperature
$inhum = $data_clientraw[23]; //inside humidity
$wchill = $data_clientraw[24]; //wind chill
$temptrend = $data_clientraw[25]; //temperature trend value
$tempTH = $data_clientraw[26]; //today's high temp
$tTempTH = $data_clientraw[27]; //time of today's high temp (hh:mm)
$tempTL = $data_clientraw[28]; //today's low temp
$TtempTL = $data_clientraw[29]; //time of today's low temp (hh:mm)
$windTM = $data_clientraw[30]; //today's high wind speed (average)
$TwindTM = $data_clientraw[31]; //time of today's high wind speed (average) (hh:mm)
$wgustTM = $data_clientraw[32]; //today's high wind gust
$TwgustTM = $data_clientraw[33]; //time of today's high wind gust (hh:mm)
$pressTH = $data_clientraw[34]; //today's high pressure
$TpressTH = $data_clientraw[35]; //time of today's high pressure (hh:mm)
$pressTL = $data_clientraw[36]; //today's low pressure
$TpressTL  = $data_clientraw[37]; //time of today's low pressure (hh:mm)
$version = $data_clientraw[38]; //Cumulus version
$build = $data_clientraw[39]; //Cumulus build number
$wgust = $data_clientraw[40]; //10-minute high gust
$heatindex = $data_clientraw[41]; //heat index
$humidex = $data_clientraw[42]; //humidex
$UV = $data_clientraw[43]; //UV index
$ET = $data_clientraw[44]; //evapotranspiration today
$SolarRad = $data_clientraw[45]; //solar radiation W/m2
$avgbearing = $data_clientraw[46]; //10-minute average wind bearing (degrees)
$rhour = $data_clientraw[47]; //rainfall last hour
$forecastnumber = $data_clientraw[48]; //The number of the current forecast as per strings.ini. If the forecast is not being provided by the station and not being generated by Cumulus a value of 0 (zero) is returned
$isdaylight = $data_clientraw[49]; //Flag to indicate that the location of the station is currently in daylight (1 = yes, 0 = No)
$SensorContactLost = $data_clientraw[50]; //If the station has lost contact with its remote sensors "Fine Offset only", a Flag number is given (1 = Yes, 0 = No)
$wdir = $data_clientraw[51]; //Average wind direction
$cloudbase  = $data_clientraw[52]; //Cloud base (value and units combined)
$cbunits = $data_clientraw[53]; //Cloud base units


// view function
// usage : http://linktoyoursite/cumulus/view-realtime.php?action=view
// save function
// usage : http://linktoyoursite/cumulus/view-realtime.php?action=save
// view function
// usage : http://linktoyoursite/cumulus/view-realtime.php?action=view
//
// ###### !!!! IMPORTANT !!!! ######
// comment these lines out if you dont need them (for security reasons)
//
// ====================================================================================================================
//

if ( isset($_REQUEST['action']) && strtolower($_REQUEST['action']) == 'viewall' ) {

echo $date . " -> date (always dd.mm.yy)<br>\n" ;
echo $time;echo" -> time(always hh:mm)<br>\n" ;
echo $temp; echo" -> outside temperature<br>\n" ;
echo $hum;echo" -> relative humidity<br>\n" ;
echo $dew;echo" -> Dewpoint<br>\n" ;
echo $wspeed;echo" -> wind speed (average)<br>\n" ;
echo $wlatest;echo" -> latest wind speed reading<br>\n" ;
echo $bearing;echo" -> wind bearing (degrees)<br>\n" ;
echo $rrate;echo" -> current rain rate (per hour)<br>\n" ;
echo $rfall;echo" -> rain today<br>\n" ;
echo $press;echo" -> barometer<br>\n" ;
echo $currentwdir;echo" -> current wind direction (compass point)<br>\n" ;
echo $beaufort;echo" -> wind speed beaufort<br>\n" ;
echo $windunit;echo" -> wind units - m/s, mph, km/h, kts<br>\n" ;
echo $tempunit;echo" -> temperature units - degree C, degree F<br>\n" ;
echo $pressunit;echo" -> pressure units - MB, hPa, in<br>\n" ;
echo $rainunit;echo" -> rain units - mm, in<br>\n" ;
echo $windrun;echo" -> wind run (today)<br>\n" ;
echo $presstrendval;echo" -> pressure trend value<br>\n" ;
echo $rmonth;echo" -> monthly rainfall<br>\n" ;
echo $ryear;echo" -> /yearly rainfall<br>\n" ;
echo $rfallY;echo" -> yesterday's rainfall<br>\n" ;
echo $intemp;echo" -> inside temperature<br>\n" ;
echo $inhum;echo" -> inside humidity<br>\n" ;
echo $wchill;echo" -> wind chill<br>\n" ;
echo $temptrend;echo" -> temperature trend value<br>\n" ;
echo $tempTH;echo" -> today's high temp<br>\n" ;
echo $tTempTH;echo" -> time of today's high temp (hh:mm)<br>\n" ;
echo $tempTL;echo" -> today's low temp<br>\n" ;
echo $TtempTL;echo" -> time of today's low temp (hh:mm)<br>\n" ;
echo $windTM;echo" -> today's high wind speed (average)<br>\n" ;
echo $TwindTM;echo" -> time of today's high wind speed (average) (hh:mm)<br>\n" ;
echo $wgustTM;echo" -> today's high wind gust<br>\n" ;
echo $TwgustTM;echo" -> time of today's high wind gust (hh:mm)<br>\n" ;
echo $pressTH;echo" -> today's high pressure<br>\n" ;
echo $TpressTH;echo" -> time of today's high pressure (hh:mm)<br>\n" ;
echo $pressTL;echo" -> today's low pressure<br>\n" ;
echo $TpressTL;echo" -> time of today's low pressure (hh:mm)<br>\n" ;
echo $version;echo" -> Cumulus version<br>\n" ;
echo $build;echo" -> Cumulus build number<br>\n" ;
echo $wgust;echo" -> 10-minute high gust<br>\n" ;
echo $heatindex;echo" -> heat index<br>\n" ;
echo $humidex;echo" -> humidex<br>\n" ;
echo $UV;echo" -> UV index<br>\n" ;
echo $ET;echo" -> evapotranspiration today<br>\n" ;
echo $SolarRad;echo" -> solar radiation W/m2<br>\n" ;
echo $avgbearing;echo" -> 10-minute average wind bearing (degrees)<br>\n" ;
echo $rhour;echo" -> rainfall last hour<br>\n" ;
echo $forecastnumber;echo" -> The number of the current forecast as per strings.ini. If the forecast is not being provided by the station and not being generated by Cumulus a value of 0 (zero) is returned<br>\n" ;
echo $isdaylight;echo" -> Flag to indicate that the location of the station is currently in daylight (1 = yes, 0 = No)<br>\n" ;
echo $SensorContactLost;echo" -> If the station has lost contact with its remote sensors (Fine Offset only), a Flag number is given (1 = Yes, 0 = No)<br>\n" ;
echo $wdir;echo" -> Average wind direction<br>\n" ;
echo $cloudbase;echo" -> Cloud base (value and units combined)<br>\n" ;
echo $cbunits;echo" -> Cloud base units<br>\n" ;
exit;
}

if ( isset($_REQUEST['action']) && strtolower($_REQUEST['action']) == 'save' ) {

$conn = mysqli_connect('inetdb.nameserver.sk','mpca86','DikfowjefJiHeb6', 'pws_mpca86');

if (!$conn) {
      echo "Debugging error: " . mysqli_connect_error();
      exit;
      }

$date =  date("Y-m-d", strtotime($date));
$time = date("H:i:s", strtotime($time));
//echo $time;
$DateTime = $date . " " . $time;

$sql = "INSERT INTO ams_amma (DateTime,T,H,W,G,B,R,RR,P) VALUES ('$DateTime','$temp','$hum','$wspeed','$wlatest','$bearing','$rfall','$rrate','$press')";
mysqli_query($conn, $sql);
$sql1 = "UPDATE ams_sk SET DateTime='$DateTime', T='$temp', H='$hum', W='$wspeed',G='$wlatest',B='$bearing',R='$rfall', RR='$rrate', P='$press' WHERE Ide = 'AMMA'";
mysqli_query($conn, $sql1);
exit;
}


?>