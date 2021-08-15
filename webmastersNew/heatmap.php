<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php'
?>
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" integrity="sha512-xodZBNTC5n17Xt2atTPuE1HxjVMSvLVW9ocqUKLsCC5CXdbqCmblAshOMAS6/keqq/sMZMZ19scR4PsZChSR7A==" crossorigin="" />
<script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js" integrity="sha512-XQoYMqMTK8LvdxXYG3nZ448hOEQiglfqkJs1NOQV44cWnUrBc8PkAOcXy20w0vlaXaVUearIOBhiXZ5V3ynxwA==" crossorigin=""></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
  leaflet - heat.js
</script>
<div id="issMap"></div>
<style>
  #issMap {
    height: 180px;
  }
</style>

<?php
/*
  $sql = "SELECT * FROM har";
  $result = mysqli_query($conn, $sql);
  $row = mysqli_fetch_assoc($result);
  $data = json_decode($row['har_data'], true);
  //echo $data["serverIPAddress"][1];
  
  $ip = $data["serverIPAddress"][1];
  $access_key = '857f8bbffec5f0b776e99d320d2f4885';

  // Initialize CURL:
  $ch = curl_init('http://api.ipapi.com/'.$ip.'?access_key='.$access_key.'& fields = latitude,longitude');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

  // Store the data:
  $json = curl_exec($ch);
  curl_close($ch);

  // Decode JSON response:
  $api_result = json_decode($json, true);

  // Output the "calling_code" object inside "location"
  //echo $api_result['latitude'];
  //echo $json;
  //echo $api_result['location']['calling_code']; 
  //header("Location: $api_result['location']");
  //echo "<script>\n";
  //echo "console.log('->',".$ip.");";
  //echo "</script>";
  */
?>

<script>
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

  $.ajax({
    url: 'AJAX/get_heatmap_data.php',
    method: 'GET',
    data: {
      name: "mariosss"
    },
    success: function(json) {
      // output the "calling_code" object inside "location"
      //alert(json.location.calling_code);
      //console.log(json);
      //marker.setLatLng([json.latitude, json.longitude])
      const mymap = L.map('issMap').setView([0, 0], 1);
      const marker = L.marker([0, 0]).addTo(mymap);
      const attribution =
        '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreatmap</a> contributors';
      const tileUrl = "https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png";
      const tiles = L.tileLayer(tileUrl, {
        attribution
      });

      tiles.addTo(mymap);
      // set endpoint and your access key
      //var ip = '2a02:26f0:c000:281::700'
      data = JSON.parse(json);
      var ip = data.serverIPAddress;
      console.log(ip);
      var access_key = '857f8bbffec5f0b776e99d320d2f4885';

      // get the API result via jQuery.ajax
      $.ajax({
        url: 'http://api.ipapi.com/' + ip + '?access_key=' + access_key,
        dataType: 'jsonp',
        success: function(json) {
          // output the "calling_code" object inside "location"
          //alert(json.location.calling_code);
          console.log(json)
          marker.setLatLng([json.latitude, json.longitude])
        }
      });
    },
    error: function() {
      alert("MMMMM");
    }
  });


  //jQuery.get("https://ipinfo.io", function(e) {
  //  console.log(e);
  // }, "jsonp")
</script>


<?php
// if (isset($_SESSION["useruid"])) {
// echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
//}
?>



<?php
include_once 'footer.php'
?>