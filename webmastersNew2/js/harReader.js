"use strict";

//let har = require("./hara.json");
//console.log(har.name);

/*
fetch("./hara.json")
  .then(function(resp) {
      return resp.json();
  })
  .then(function(data) {
    console.log(data);
    entries = data.entries;
  });*/

//const responce = fetch("./hara.json");
//const data = responce.json();
//console.log(data);

fetch("./hara.json")
  .then(response => response.json())
  .then(json => console.log(json))
  .catch(err =>console.log(err));
/*const input = document.querySelector('input[type="file"]')
input.addEventListener('change', function (e) {
  console.log(input.files)
  const reader = new FileReader()
  reader.onload = function () {
    //console.log(reader.result)
    console.log(reader.name)
    }
  reader.readAsText(input.files[0])
}, false)*/
