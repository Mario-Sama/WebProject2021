<?php
include_once 'header.php';
?>
<style>
  #file-selector {
    border: 5px dashed red;
    width: 450px;
    height: 250px;
  }
</style>

<?php

?>

<input type="file" id="file-selector" multiple accept=".har, .json">
<p id="status"></p>
<div>
  <p id="output"> </p>
</div>

<div id="downloadButton"></div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script>
  src = "https://cdnjs.cloudflare.com/ajax/libs/d3/7.0.1/d3.min.js"
</script>
<script src="http://d3js.org/d3.v3.min.js" charset="utf-8"></script>

<script>
  let ipad;
  let newHar = {};
  fetch("https://api.ipify.org/?format=json")
    .then(results => results.json())
    .then(data => ipad = data.ip);

  const fileSelector = document.getElementById("file-selector");
  fileSelector.addEventListener('change', (event) => {
    const fileList = event.target.files;
    const reader = new FileReader();
    reader.onload = function() {
      const json = JSON.parse(reader.result);
      console.log(ipad);
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
        obj.requestUrl = json.log.entries[i].request.url;
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
        link.download = "demo.json";
        link.click();
        window.URL.revokeObjectURL(url);
      };
      var container = document.getElementById('downloadButton');
      container.appendChild(button);

      $.ajax({
        url: "AJAX/get_har_data.php",
        method: "post",
        data: {
          har: JSON.stringify(newHar),
          ip: ipad
        },
        success: function(res) {
          console.log(res);
        }
      });
      //console.log(harData);
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

