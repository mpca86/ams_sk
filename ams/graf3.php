<?php
$conn = mysqli_connect('inetdb.nameserver.sk','mpca86','DikfowjefJiHeb6', 'pws_mpca86');
if (!$conn) {
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}
$query = "SELECT `DateTime`, `T` FROM ams_BRE0";
$result = mysqli_query($conn, $query);
$T = array();
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
$T[$index]=$row;
$T[$index][0]=(strtotime($T[$index][0])*1000);
$index++;
}

$query = "SELECT `DateTime`, `H` FROM ams_BRE0";
$result = mysqli_query($conn, $query);
$H = array();
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
$H[$index]=$row;
$H[$index][0]=(strtotime($H[$index][0])*1000);
$index++;
}

$query = "SELECT `DateTime`, `G` FROM ams_BRE0";
$result = mysqli_query($conn, $query);
$G = array();
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
$G[$index]=$row;
$G[$index][0]=(strtotime($G[$index][0])*1000);
$index++;
}

$query = "SELECT `DateTime`, `P` FROM ams_BRE0";
$result = mysqli_query($conn, $query);
$P = array();
$index = 0;
while ($row = mysqli_fetch_array($result, MYSQLI_NUM))
{
$P[$index]=$row;
$P[$index][0]=(strtotime($P[$index][0])*1000);
$index++;
}

$query1 = "SELECT `DateTime` FROM ams_BRE0 ORDER BY `DateTime` DESC LIMIT 1";
$result1 = mysqli_query($conn, $query1);
$upd = mysqli_fetch_array($result1, MYSQLI_NUM);
//var_dump($upd);
//echo  $upd[0];
mysqli_close();
?>
<!DOCTYPE html>
<html lang="sk">
  <head>
    <!-- Basic Page Needs
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta charset="utf-8">
    <title>Grafy pre AMS.sk</title>
    <meta name="description" content="Grafy pre AMS.sk">
    <meta name="author" content="Martin Šturcel">
    <!-- Mobile Specific Metas
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="./img/ams_square_medium.png">
    <!-- FONT
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">
    <!-- CSS
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
    <link rel="stylesheet" href="//sturcel.sk/martin/ams/css/normalize.css">
    <link rel="stylesheet" href="//sturcel.sk/martin/ams/css/skeleton.css">
    <!-- Favicon
    –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</head>
  <body>
    <div class="container">
      <div class="row">
	      <form id="datetime_range" action="//sturcel.sk/martin/ams/graf3.php" method="GET">
	        <!-- <div class="row">          -->
	          <div class="three columns">
	            <label>Od</label>
	            <input class="u-full-width" id="datetimepicker1" type="text" value="{{from_date}}" name="from">
	          </div>
	        <!-- </div> -->
	        <!-- <div class="row"> -->
	          <div class="three columns">
	            <label>Do</label>
	            <input class="u-full-width" id="datetimepicker2" type="text" value="{{to_date}}" name="to">
	          </div>
	        <!-- </div>          -->
	        <!-- <div class="row"> -->
	          <div class="two columns">
	            <input type="hidden" class="timezone" name="timezone" />
	            <input class="button-primary" type="submit" value="Vybrať" style="position:relative; top: 28px" id="submit_button" />
	          </div>
	        <!-- </div> -->
	      </form>
      </div>
      <div class="row">
      <div class="eleven columns">
        <form id="range_select" action = "//sturcel.sk/martin/ams/graf3.php" method="GET">
          <input type="hidden" class="timezone" name="timezone" />
          <div class="one column">
            <input type="radio" name="range_h" value="3" id="radio_3" /><label for="radio_3">3h</label>
          </div>
          <div class="one column">
            <input type="radio" name="range_h" value="6" id="radio_6" /><label for="radio_6">6h</label>
          </div>
          <div class="one column">
            <input type="radio" name="range_h" value="12" id="radio_12" /><label for="radio_12">12h</label>
          </div>
          <div class="one column">
            <input type="radio" name="range_h" value="24" id="radio_24" /><label for="radio_24">24h</label>
          </div>
        </form>
      </div>
    </div>
    <div class="row">
     <a href="" id="plotly_url" target="_blank"></a><span id="plotly_wait"></span>
	</div>
      <div class="row">

                <div id="chart_temps"></div>
                <div id="chart_humid"></div>

      </div>
     </div>

  <script src="//code.jquery.com/jquery-1.11.2.min.js"></script>
  <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
  <link rel="stylesheet" type="text/css" href="//sturcel.sk/martin/ams/css/jquery.datetimepicker.css">
  <script src="//sturcel.sk/martin/ams/js/jquery.datetimepicker.full.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jstimezonedetect/1.0.4/jstz.min.js" ></script>


  <script>
    jQuery( "#datetime_range" ).submit(function( event ) {
        timezone = jstz.determine();
        jQuery(".timezone").val(timezone.name());
    });
    jQuery('#datetimepicker1').datetimepicker(
      {
        format:'Y-m-d H:i',
        defaultDate:''
      });
    jQuery('#datetimepicker2').datetimepicker({
        format:'Y-m-d H:i',
        defaultDate:''
      });
    jQuery("#range_select input[type=radio]").click(function(){
        timezone = jstz.determine();
        jQuery(".timezone").val(timezone.name());
        jQuery("#range_select").submit();
      });

      jQuery("#range_select input[type=radio]").click(function(){
            timezone = jstz.determine();
            jQuery(".timezone").val(timezone.name());
            jQuery("#range_select").submit();
          });
    </script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/modules/boost.js"></script>
    <script src="https://code.highcharts.com/modules/exporting.js"></script>


    <script>
     var update = <?php echo "\"" . $upd[0] . "\""; ?>;
      console.time('line');
      Highcharts.setOptions({
          global: {
        useUTC: false,
      },
        lang: {
        months: [
            'Január', 'Február', 'Marec', 'Apríl', 'Máj', 'Jún', 'Júl', 'August', 'September', 'Október', 'November', 'December'
        ],
        weekdays: [
            'Nedeľa', 'Pondelok', 'Utorok', 'Streda', 'Štvrtok', 'Piatok', 'Sobota'
        ],
        decimalPoint: ",",
        downloadCSV:"Stiahnúť ako CSV",
        downloadJPEG:"Stiahnúť ako JPEG",
        downloadPDF:"Stiahnúť ako PDF",
        downloadPNG:"Stiahnúť ako PNG",
        downloadSVG:"Stiahnúť ako SVG",
        downloadXLS:"Stiahnúť ako XLS",
        noData:"Žiadne údaje pre zobrazenie",
        printChart:"Vytlačiť graf",
        resetZoom:"Obnoviť priblíženie",
        resetZoomTitle:"Obnoviť priblíženie na mierku 1:1"
    }
      });

      Highcharts.chart('chart_temps', {

        chart: {
          zoomType: 'x'
        },

        title: {
          text: 'Graf nameraných hodnôt pre Brezno'
        },

        credits: {
          text: 'Zdroj: amaterskameteorologia.sk',
          href: 'https://www.amaterskameteorologia.sk',
          position: {
              align: 'right',
              x: -10
          },
          style: {
              color: '#909090',
              fontSize: '9px'
          }
        },

        subtitle: {
          text: 'Posledná aktualizácia: ' + update
        },

        tooltip: {
          valueDecimals: 2
        },
        yAxis: [{ // Primary yAxis
            labels: {
                format: '{value}°C',
                    },
            title: {
                text: 'Teplota',
                    },

        }, { // Secondary yAxis
            labels: {
                format: '{value}%',
                    },
            title: {
                text: 'Vlhkosť',
                    },
                    opposite: true
        },{ // Tretiary yAxis
            title: {
                text: 'Gust',
                  },
            labels: {
                format: '{value} m/s',
                    }

        }, { // Quatro yAxis
            title: {
                text: 'Atm. tlak',
                    },
            labels: {
                format: '{value} hPa',
                    },
            opposite: true
        }],
        xAxis: {
          type: 'datetime',
                },

        series: [{
          data: <?php echo json_encode($P, JSON_NUMERIC_CHECK); ?>,
          name: 'Atm. tlak',
          yAxis: 3,
          tooltip: {
            valueSuffix: ' hPa'
        }
        },{
          data: <?php echo json_encode($H, JSON_NUMERIC_CHECK); ?>,
          name: 'Vlhkosť',
            yAxis: 1,
            tooltip: {
            valueSuffix: '%'
        }
        },{
          data: <?php echo json_encode($G, JSON_NUMERIC_CHECK); ?>,
          name: 'Gust',
          yAxis: 2,
          tooltip: {
            valueSuffix: ' m/s'
        }
        },{
          data: <?php echo json_encode($T, JSON_NUMERIC_CHECK); ?>,
          name: 'Teplota',
            yAxis: 0,
            tooltip: {
            valueSuffix: '°C'
        }
        }]

      });
      console.timeEnd('line');

</script>

 </body>
</html>
