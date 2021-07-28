"use strict";

let entries;

fetch("./www.tesla.com")
  .then(function(resp) {
      return resp.json();
  })
  .then(function(data) {
    console.log(data);
    entries = data.entries;
  });
/*const input = document.querySelector('input[type="file"]')
input.addEventListener('change', function (e) {
  console.log(input.files)
  const reader = new FileReader()
  reader.onload = function () {
    //console.log(reader.result)
    console.log(reader.entries)
    }
  reader.readAsText(input.files[0])
}, false)*/
