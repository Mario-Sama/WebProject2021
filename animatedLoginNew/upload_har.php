<?php
  include_once 'header.php';
?>
<!--<style>
      #file-selector {
        border: 5px dashed red;
        width: 450px;
        height: 250px;
      }
</style>  -->

<?php
  if (isset($_SESSION["useruid"])) {
    echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
  }
?>


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

      <a href="accountSettings.php">
        <button type="button" name="settings">Edit Account Settings</button>
      </a>

  <input type="file" class="choose-files" id="file-selector" multiple  accept=".har, .jpg, .png, .json">
  <button type="submit" name="harSubmit">Upload</button>
  <p id="status"></p>
      <div>
        <p id="output"> </p>
      </div>
  <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
<script>
/*
const fileSelector = document.getElementById("file-selector");
fileSelector.addEventListener('change', (event) => {
  const fileList = event.target.files;
  //console.log(fileList);
  const reader = new FileReader();
  reader.onload = function() {
    const json = JSON.parse(reader.result);
    console.log(12)
    console.log(json);
    let method = [];
    for (let i = 0; i < json.log.entries.length; i++) {
      let url = json.log.entries[i].request.url;
      console.log("method = "+json.log.entries[i].request.method);
      //console.log("method = "+typeof(json.log.entries[i].request.method));
      //console.log("url = "+json.log.entries[i].request.url);
      console.log("url = "+typeof(json.log.entries[i].request.url));
      method.push(json.log.entries[i].request.method);
      console.log(method[i])
      console.log(url)
      let name;
      for (let j = 0; j < json.log.entries[i].request.headers.length; j++) {
        name = json.log.entries[i].request.headers[j].name;
        if (name === "content-type" || name === "cache-control" ||  name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            //console.log(name+" == "+json.log.entries[i].request.headers[j].name);
            //console.log(typeof(json.log.entries[i].request.headers[j].name));
            //console.log(name+" == "+json.log.entries[i].request.headers[j].value);
            //console.log(typeof(json.log.entries[i].request.headers[j].value));
        }
      }
      for (j = 0; j < json.log.entries[i].response.headers.length; j++) {
        name = json.log.entries[i].response.headers[j].name;
        if (name === "content-type" || name === "cache-control" ||  name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            //console.log(name+" == "+json.log.entries[i].response.headers[j].name);
            //console.log(typeof(json.log.entries[i].response.headers[j].name));
            //console.log(name+" == "+json.log.entries[i].response.headers[j].value);
            //console.log(typeof(json.log.entries[i].response.headers[j].value));
        }
      }
    //console.log("startedDateTime = "+json.log.entries[i].startedDateTime);
    //console.log(typeof(json.log.entries[i].startedDateTime));
    //console.log("serverIPAddress = "+json.log.entries[i].serverIPAddress);
    //console.log(typeof(json.log.entries[i].serverIPAddress));
    //console.log("wait = "+json.log.entries[i].timings.wait);
    //console.log(typeof(json.log.entries[i].timings.wait));
    //console.log("status = "+json.log.entries[i].response.status);
    //console.log(typeof(json.log.entries[i].response.status));
    //console.log("statusText = "+json.log.entries[i].response.statusText);
    //console.log(typeof(json.log.entries[i].response.statusText));
    }
    let httpr = new XMLHttpRequest();

    httpr.open("POST","AJAX/get_har_data.php", true);
    let car = 1;
    console.log(method)
    let params = `method=${car}`;

    httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    httpr.onload = function() {
      console.log(httpr.responseText);
    };
      httpr.send(params);
  }
})
const dropArea = document.getElementById('drop-area');
if (dropArea) {
  dropArea.addEventListener('dragover', (event) => {
    event.stopPropagation();
    event.preventDefault();
    // Style the drag-and-drop as a "copy file" operation.
    event.dataTransfer.dropEffect = 'copy';
  });
}
if (dropArea) {
  dropArea.addEventListener('drop', (event) => {
    event.stopPropagation();
    event.preventDefault();
    const fileList = event.dataTransfer.files;
    //console.log(fileList);
  });
}
*/
fetch("./js/har.har")
  .then(response => response.json())
  .then(json => {
    //console.log(json)
    var harData = {};
    //console.log(harData);
    let requestMethod = [];
    let requestUrl = [];
    let requestHeadersName = [];
    let requestHeadersValue = [];
    let startedDateTime = [];
    let serverIPAddress = [];
    let wait = [];
    let status = [];
    let statusText = [];

    for (let i = 0; i < json.log.entries.length; i++) {
      requestMethod.push(json.log.entries[i].request.method)
      requestUrl.push(json.log.entries[i].request.url)
      /*
      console.log("method = "+json.log.entries[i].request.method);
      console.log("method = "+typeof(json.log.entries[i].request.method));
      console.log("url = "+json.log.entries[i].request.url);
      console.log("url = "+typeof(json.log.entries[i].request.url));
      */
      let name;
      for (let j = 0; j < json.log.entries[i].request.headers.length; j++) {
        name = json.log.entries[i].request.headers[j].name;
        if (name === "content-type" || name === "cache-control" ||  name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            requestMethod.push(json.log.entries[i].request.headers[j].name)
            requestUrl.push(json.log.entries[i].request.headers[j].value)
              /*
            console.log(name+" == "+json.log.entries[i].request.headers[j].name);
            console.log(typeof(json.log.entries[i].request.headers[j].name));
            console.log(name+" == "+json.log.entries[i].request.headers[j].value);
            console.log(typeof(json.log.entries[i].request.headers[j].value));
            */
        }
      }
      for (j = 0; j < json.log.entries[i].response.headers.length; j++) {
        name = json.log.entries[i].response.headers[j].name;
        if (name === "content-type" || name === "cache-control" ||  name === "pragma" || name === "expires" ||
            name === "age" || name === "last-modified" || name === "Host") {
            requestMethod.push(json.log.entries[i].response.headers[j].name)
            requestUrl.push(json.log.entries[i].response.headers[j].value)
              /*
            console.log(name+" == "+json.log.entries[i].response.headers[j].name);
            console.log(typeof(json.log.entries[i].response.headers[j].name));
            console.log(name+" == "+json.log.entries[i].response.headers[j].value);
            console.log(typeof(json.log.entries[i].response.headers[j].value));
            */
        }
      }
      /*
    console.log("startedDateTime = "+json.log.entries[i].startedDateTime);
    console.log(typeof(json.log.entries[i].startedDateTime));
    console.log("serverIPAddress = "+json.log.entries[i].serverIPAddress);
    console.log(typeof(json.log.entries[i].serverIPAddress));
    console.log("wait = "+json.log.entries[i].timings.wait);
    console.log(typeof(json.log.entries[i].timings.wait));
    console.log("status = "+json.log.entries[i].response.status);
    console.log(typeof(json.log.entries[i].response.status));
    console.log("statusText = "+json.log.entries[i].response.statusText);
    console.log(typeof(json.log.entries[i].response.statusText));
    */
    startedDateTime.push(json.log.entries[i].startedDateTime)
    serverIPAddress.push(json.log.entries[i].serverIPAddress)
    wait.push(json.log.entries[i].timings.wait)
    status.push(json.log.entries[i].response.status)
    statusText.push(json.log.entries[i].response.statusText)
    }
    harData.requestMethod = requestMethod;
    harData.requestUrl = requestUrl;
    harData.requestHeadersName = requestHeadersName;
    harData.requestHeadersValue = requestHeadersValue;
    harData.startedDateTime = startedDateTime;
    harData.serverIPAddress = serverIPAddress;
    harData.wait = wait;
    harData.status = status;
    harData.statusText = statusText;
    //console.log(harData)

    let httpr = new XMLHttpRequest();
    //let har = 1;
    httpr.open("POST",'AJAX/get_har_data.php', true);
    //httpr.onreadystatechange = function() { //Call a function when the state changes.
      //  if(this.readyState == 4 && this.status == 200) { // complete and no errors
            //alert(httpr.responseText); // some processing here, or whatever you want to do with the response
        //}
        //else {
          //alert(httpr.statusText)
        //}
    //};

    //let params = `har_data=${harData}`;
    var params = {
      har_data: harData
    };

    //console.log(harData)

    httpr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");

    httpr.onload = function() {
      console.log(httpr.responseText);
    };
    //console.log(JSON.stringify(params));
    //console.log(params);
    httpr.send(params);
    //$.post('AJAX/get_har_data.php',harData)
    //$.post("AJAX/get_har_data.php", params);
    var ip = "<?php echo $_SERVER['SERVER_ADDR']; ?>";
    alert(ip);
    })
  .catch(err =>console.log(err));

  </script>


<?php
  include_once 'footer.php'
?>
