<?php
include_once 'header.php';
?>
<?php
if (!isset($_SESSION['useruid']) || $_SESSION['isAdmin'] != 0) {
  header('Location: index.php');
}
?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link rel="stylesheet" href="style.css">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Stick+No+Bills:wght@200&display=swap" rel="stylesheet">



<input type="file" class="choose-files" id="file-selector" multiple accept=".har, .json">
<p id="status"></p>
<div>
  <p id="output"> </p>
</div>

<div id="downloadButton"></div>

<!-- style>
  #file-selector {
    border: 5px dashed red;
    width: 450px;
    height: 250px;
  }
</style> -->


<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script>
  src = "https://cdnjs.cloudflare.com/ajax/libs/d3/7.0.1/d3.min.js"
</script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<script>
  let ipad;
  let provider;
  let lang;
  let long;
  let newHar = {};

  /*
    fetch("https://geo.ipify.org/api/v1?apiKey=at_EM4h3JKGD8rRvV81UnxCXmAmtQWVc")
      .then(results => results.json())
      .then(data => {
        ipad = data.ip;
        provider = data.as.name;
        lang = data.location.lat;
        long = data.location.lng;
               });

  */


  //works except for provider
  /*
      fetch("http://api.ipapi.com/api/check?access_key=88b994663645ad5e9fa0b0c829df23b4")
        .then(results => results.json())
        .then(data => {
          ipad = data.ip;
          //provider = data.connection.isp;
          lang = data.latitude;
          long = data.longitude;
               });
  */


  fetch("https://ipapi.co/json/")
    .then(results => results.json())
    .then(data => {
      ipad = data.ip;
      provider = data.org;
      lang = data.latitude;
      long = data.longitude;
    });


  const fileSelector = document.getElementById("file-selector");
  fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
    const reader = new FileReader();
    reader.onload = function() {
      const json = JSON.parse(reader.result);
      console.log(ipad);
      console.log(provider);
      console.log(lang);
      console.log(long);
      console.log(json);
      let harData = {};
      let list = []
      let requestMethod = [];
      let requestUrl = [];
      let requestHeadersName = [];
      let requestHeadersValue = [];
      let responseHeadersName = [];
      let responseHeadersValue = [];
      let startedDateTime = [];
      let serverIPAddress = [];
      let wait = [];
      let status = [];
      let statusText = [];

      for (let i = 0; i < json.log.entries.length; i++) {
        requestMethod.push(json.log.entries[i].request.method);
        requestUrl.push(json.log.entries[i].request.url);
        const obj = {};
        const requestHeaders = {};
        const responseHeaders = {};
        obj.requestMethod = json.log.entries[i].request.method;
        //obj.requestUrl = json.log.entries[i].request.url;
        obj.requestUrl = json.log.entries[i].request.url.match(/(?:[^@\n]+@)?(?:www\.)?([^:\/\n?]+)/img)[1];

        //obj.requestHeadersName = [];
        //obj.requestHeadersValue = [];
        //obj.responseHeadersName = [];
        //obj.responseHeadersValue = [];
        let name;
        for (let j = 0; j < json.log.entries[i].request.headers.length; j++) {
          name = json.log.entries[i].request.headers[j].name;
          if (name === "content-type" || name === "cache-control" || name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            requestHeadersName.push(json.log.entries[i].request.headers[j].name);
            requestHeadersValue.push(json.log.entries[i].request.headers[j].value);
            //obj.requestHeadersName = json.log.entries[i].request.headers[j].name;
            //obj.requestHeadersValue = json.log.entries[i].request.headers[j].value;
            requestHeaders[name] = json.log.entries[i].request.headers[j].value;
          }
        }
        obj.requestHeaders = requestHeaders;

        for (j = 0; j < json.log.entries[i].response.headers.length; j++) {
          name = json.log.entries[i].response.headers[j].name;
          if (name === "content-type" || name === "cache-control" || name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            responseHeadersName.push(json.log.entries[i].response.headers[j].name);
            responseHeadersValue.push(json.log.entries[i].response.headers[j].value);
            //obj.responseHeadersName.push(json.log.entries[i].response.headers[j].name);
            //obj.responseHeadersValue.push(json.log.entries[i].response.headers[j].value);
            responseHeaders[name] = json.log.entries[i].response.headers[j].value;
          }
        }
        obj.responseHeaders = responseHeaders;

        startedDateTime.push(json.log.entries[i].startedDateTime);
        serverIPAddress.push(json.log.entries[i].serverIPAddress);
        wait.push(json.log.entries[i].timings.wait);
        status.push(json.log.entries[i].response.status);
        statusText.push(json.log.entries[i].response.statusText);

        obj.startedDateTime = json.log.entries[i].startedDateTime;
        obj.serverIPAddress = json.log.entries[i].serverIPAddress;
        obj.wait = json.log.entries[i].timings.wait;
        obj.status = json.log.entries[i].response.status;
        obj.statusText = json.log.entries[i].response.statusText;
        list.push(obj);
      }
      harData.requestMethod = requestMethod;
      harData.requestUrl = requestUrl;
      harData.requestHeadersName = requestHeadersName;
      harData.requestHeadersValue = requestHeadersValue;
      harData.responseHeadersName = responseHeadersName;
      harData.responseHeadersValue = responseHeadersValue;
      harData.startedDateTime = startedDateTime;
      harData.serverIPAddress = serverIPAddress;
      harData.wait = wait;
      harData.status = status;
      harData.statusText = statusText;
      newHar = list;
      console.log(newHar);

      var button = document.createElement('button');
      button.type = 'button';
      button.innerHTML = 'Download JSON';
      button.className = 'btn-styled';

      button.onclick = function() {
        var myBlob = new Blob([JSON.stringify(newHar)], {
          type: "json"
        });
        console.log(myBlob);
        var url = window.URL.createObjectURL(myBlob);
        var link = document.createElement("a");
        link.href = url;
        link.download = "filtered.json";
        link.click();
        window.URL.revokeObjectURL(url);
      };
      var container = document.getElementById('downloadButton');
      container.appendChild(button);


      /*      WASNT USED
            var rawstringoriginal =  JSON.stringify(json)                             //store raw file uploaded by the user in a variable to use it specifically for finding the domain and the providers.
            $.post("UploadHarDatatoDB.php", {originaldata:rawstringoriginal} ,function(){
              //alert("Original Json uploaded successfully!");
            } );
      */

      // Make newHar which cointains filtered har data in json form and make them raw text .

      var rawstring = JSON.stringify(newHar) //send raw input to the file as text and not in json format(for some weird reason it won't accept json datatype)
      $.post("UploadHarDatatoDB.php", {
        data: rawstring
      }, function() { //send the contents of the js object rawstring in UploadHarDatatoDB.php
        alert("Filtered Json fields uploaded successfully to the Database!"); //Popup message for confirmation
      });


      //Post js variables with ajax to use for extracting user's parameters in database

      $.ajax({
        url: "AJAX/requestedipinfo.php",
        method: "post",
        data: {
          usersIp: ipad,
          latitude: lang,
          longitude: long,
          provider: provider
        },
        success: function(res) {
          console.log(res);
        }
      });

      $.ajax({
        url: "AJAX/get_har_data.php",
        method: "post",
        data: {
          har: JSON.stringify(newHar),
          //ip: ipad
        },
        success: function(res) {
          console.log(res);
        }
      });
    }
    reader.readAsText(fileList[0]);
  });









  // const dropArea = document.getElementById('drop-area');
  // if (dropArea) {
  // dropArea.addEventListener('dragover', (event) => {
  // event.stopPropagation();
  // event.preventDefault();
  // // Style the drag-and-drop as a "copy file" operation.
  // event.dataTransfer.dropEffect = 'copy';
  // });
  // }
  // if (dropArea) {
  // dropArea.addEventListener('drop', (event) => {
  // event.stopPropagation();
  // event.preventDefault();
  // const fileList = event.dataTransfer.files;
  // //console.log(fileList);
  // });
  // }
</script>