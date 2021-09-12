<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php'
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"></script>
<script src="https://cdn.jsdelivr.net/npm/heatmapjs@2.0.2/heatmap.js"></script>
<script src="https://cdn.jsdelivr.net/npm/leaflet-heatmap@1.0.0/leaflet-heatmap.js"></script>

<div id="mapid"></div>
<!-- 
<style>
  #issMap {
    height: 180px;
  }
</style> -->
<style>
  #mapid {
    height: 180px;
    width: 50%;
    align: "center"
  }
</style>


<?php
/*
  $sql = "SELECT * FROM har";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $data = json_decode($row['har_data'], true);
  echo $data["serverIPAddress"][1];
  
  $ip = $data["serverIPAddress"][1];
  $access_key = '857f8bbffec5f0b776e99d320d2f4885';

  Initialize CURL:
  $ch = curl_init('http://api.ipapi.com/'.$ip.'?access_key='.$access_key.'& fields = latitude,longitude');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  Store the data:
  $json = curl_exec($ch);
  curl_close($ch);

  Decode JSON response:
  $api_result = json_decode($json, true);

  Output the "calling_code" object inside "location"
  echo $api_result['latitude'];
  echo $json;
  echo $api_result['location']['calling_code']; 
  header("Location: $api_result['location']");
  echo "<script>\n";
  echo "console.log('->',".$ip.");";
  echo "</script>";
  */
?>

<script>
  // var location = [];
  // var point = {
  //   lat: null,
  //   lng: null
  // };
  var myvar = '<?= $_SESSION["useruid"]; ?>';
  //console.log(myvar)
  $.ajax({
    url: 'AJAX/get_heatmap_data.php',
    method: 'GET',
    data: {
      name: myvar
    },
    success: function(json) {
      // output the "calling_code" object inside "location"
      //alert(json.location.calling_code);
      //console.log(json);
      //marker.setLatLng([json.latitude, json.longitude])
      //const mymap = L.map('issMap').setView([0, 0], 1);
      //const marker = L.marker([0, 0]).addTo(mymap);
      // set endpoint and your access key
      var data = JSON.parse(json);
      console.log(data);
      let ip = [];
      for (i = 0; i < data.length; i++) {
        if (data[i].serverIPAddress)
          ip.push(data[i].serverIPAddress);
      }
      //let df = Object.keys(ip);
      //var ip_data = ip.slice(0, 2);
      console.log(ip);
      var access_key = '857f8bbffec5f0b776e99d320d2f4885';

      // get the API result via jQuery.ajax
      let node = {};
      const nodeList = [];
      for (let i = 0; i < ip.length; i++) {
        $.ajax({
          url: 'http://api.ipapi.com/' + ip[i] + '?access_key=' + access_key,
          dataType: 'json',
          success: function(ipData) {
            // output the "calling_code" object inside "location"
            //alert(json.location.calling_code);
            //location.push
            //console.log(ipData.latitude);
            node.lat = ipData.latitude;
            node.lng = ipData.longitude;
            console.log(node);
            nodeList.push(node);
            //marker.setLatLng([json.latitude, json.longitude])
          }
        });
      }
      console.log(nodeList);
      let mymap = L.map("mapid");
      let osmUrl = "https://tile.openstreetmap.org/{z}/{x}/{y}.png";
      let osmAttrib =
        'Map data © <a href="https://openstreetmap.org">OpenStreetMap</a> contributors';
      let osm = new L.TileLayer(osmUrl, {
        attribution: osmAttrib
      });
      mymap.addLayer(osm);
      mymap.setView([38.246242, 21.7350847], 8);


      let testData = {
        max: 8,
        data: [{
            lat: 38.246242,
            lng: 21.735085,
            count: 3
          },
          {
            lat: 38.323343,
            lng: 21.865082,
            count: 2
          },
          {
            lat: 38.34381,
            lng: 21.57074,
            count: 8
          },
          {
            lat: 38.108628,
            lng: 21.502075,
            count: 7
          },
          {
            lat: 38.123034,
            lng: 21.917725,
            count: 4
          }
        ]
      };

      let cfg = {
        // radius should be small ONLY if scaleRadius is true (or small radius is intended)
        // if scaleRadius is false it will be the constant radius used in pixels
        "radius": 40,
        "maxOpacity": 0.8,
        // scales the radius based on map zoom
        "scaleRadius": false,
        // if set to false the heatmap uses the global maximum for colorization
        // if activated: uses the data maximum within the current map boundaries
        //   (there will always be a red spot with useLocalExtremas true)
        "useLocalExtrema": false,
        // which field name in your data represents the latitude - default "lat"
        latField: 'lat',
        // which field name in your data represents the longitude - default "lng"
        lngField: 'lng',
        // which field name in your data represents the data value - default "value"
        valueField: 'count'
      };

      let heatmapLayer = new HeatmapOverlay(cfg);

      mymap.addLayer(heatmapLayer);
      heatmapLayer.setData(testData);
    },
    error: function() {
      alert("Something went wrong!!!");
    }
  });
  // jQuery.get("https://ipinfo.io", function(e) {
  //  console.log(e);
  // }, "jsonp")


  /*
fetch('https://ipapi.co/8.8.8.8?access_key=857f8bbffec5f0b776e99d320d2f4885/json/')
  .then(function(response) {
    response.json().then(jsonData => {
      console.log(jsonData);
    });
  })
.catch(function(error) {
  console.log(error)
});
*/

  // $.ajax({
  //   url: 'AJAX/get_heatmap_data.php',
  //   method: 'GET',
  //   data: {
  //     name: "mariosss"
  //   },
  //   success: function(json) {
  //     // output the "calling_code" object inside "location"
  //     //alert(json.location.calling_code);
  //     //console.log(json);
  //     //marker.setLatLng([json.latitude, json.longitude])
  //     //const mymap = L.map('issMap').setView([0, 0], 1);
  //     //const marker = L.marker([0, 0]).addTo(mymap);
  //     var heat = L.heatLayer([
  //       [50.5, 30.5, 0.2], // lat, lng, intensity
  //       [50.6, 30.4, 0.5]
  //     ], {
  //       radius: 25
  //     }).addTo(map);
  //     const attribution =
  //       '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreatmap</a> contributors';
  //     const tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
  //     const tiles = L.tileLayer(tileUrl, {
  //       attribution
  //     });

  //     tiles.addTo(mymap);
  //     // set endpoint and your access key
  //     //var ip = '2a02:26f0:c000:281::700'
  //     data = JSON.parse(json);
  //     var ip = data.serverIPAddress;
  //     console.log(ip);
  //     var access_key = '857f8bbffec5f0b776e99d320d2f4885';

  //     // get the API result via jQuery.ajax
  //     $.ajax({
  //       url: 'http://api.ipapi.com/' + ip + '?access_key=' + access_key,
  //       dataType: 'jsonp',
  //       success: function(json) {
  //         // output the "calling_code" object inside "location"
  //         //alert(json.location.calling_code);
  //         console.log(json)
  //         marker.setLatLng([json.latitude, json.longitude])
  //       }
  //     });
  //   },
  //   error: function() {
  //     alert("MMMMM");
  //   }
  // });


  //jQuery.get("https://ipinfo.io", function(e) {
  //  console.log(e);
  // }, "jsonp")
</script>