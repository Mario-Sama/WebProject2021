<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php'
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta charset="utf-8">
    <title></title>
</head>
<style type="text/css">
    .chartBox {
        width: 500px;
    }
</style>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<div class="chartBox">
    <canvas id="myChart"></canvas>
</div>
<?php
if (!isset($_SESSION['useruid']) || $_SESSION['isAdmin'] == false) {
    header('Location: index.php');
}

?>
<style>
    .mul-select {
        width: 100%;
    }
</style>
<div class="container-fluid h-100 bg-light text-dark">
    <div class="row justify-content-center align-items-center">
        <h1>Select Content Type</h1>
    </div>
    <br>
    <div class="row justify-content-center align-items-center h-100">
        <div class="col col-sm-6 col-md-6 col-lg-4 col-xl-3">
            <div class="form-group">
                <select class="mul-select" multiple="true">
                    <option value='text/html'>text/html</option>
                    <option value='text/css'>text/css</option>
                    <option value='image/jpeg'>image/jpeg</option>
                    <option value='image/png'>image/png</option>
                    <option value='application/javascript'>application/javascript</option>
                    <option value='application/json'>application/json</option>
                    <option value='text/javascript'>text/javascript</option>
                    <option value='text/plain'>text/plain</option>
                    <option value='image/vnd.microsoft.icon'>image/vnd.microsoft.icon</option>
                </select>
            </div>
        </div>
    </div>
</div>
<script>
    $(document).ready(function() {
        $(".mul-select").select2({
            placeholder: "select content-type", //placeholder
            tags: true,
            tokenSeparators: ['/', ',', ';', " "]
        });
        console.log($('.mul-select').find(':selected'));
    })
</script>

<script>
    //let canvas = ["1", "2"]
    $.ajax({
        url: 'AJAX/get_heatmap_data.php',
        method: "GET",
        data: {
            name: "mariosss"
        },
        success: function(json) {
            console.log(json);
            var data = JSON.parse(json);
            console.log(data);
            //for (let k = 0; k < 2; k++) {
            let content = [];
            for (i = 0; i < data.length; i++) {
                if ("content-type" in data[i].responseHeaders) { // Collect all the cache control data
                    content.push(data[i].responseHeaders["content-type"]);
                }
            }
            const tempCon = [];
            for (i = 0; i < content.length; i++) {
                let temp = content[i].split(';');
                tempCon.push(temp[0]);
            }
            content = tempCon;
            console.log("content");
            console.log(content);
            let uniqueCon = [];
            let freqCon = [];
            j = -1;
            for (i = 0; i < content.length; i++) { // Find the frequency and the of each value
                if (!uniqueCon.includes(content[i])) {
                    uniqueCon.push(content[i]);
                    freqCon.push(1);
                    j++;
                } else {
                    freqCon[j]++;
                }
            }
            //console.log("uniquecon");
            //console.log(uniqueCon);
            //console.log("frequencycon");
            //console.log(freqCon);
            //for (let k = 0; k < 2; k++) {
            let histogramData = [];
            let cache = [];
            for (let i = 0; i < data.length; i++) {
                if ("cache-control" in data[i].responseHeaders) { // Collect all the cache control data
                    cache.push(data[i].responseHeaders['cache-control']);
                }
            }
            //console.log("cache");
            //console.log(cache);
            let uniqueCache = [];
            let freqCache = [];
            j = -1;
            for (i = 0; i < cache.length; i++) { // Find the frequency and the of each value
                if (!uniqueCache.includes(cache[i])) {
                    uniqueCache.push(cache[i]);
                    freqCache.push(1);
                    j++;
                } else {
                    freqCache[j]++;
                }
            }

            let cacheControl = []; // Contains the cache controll directives
            for (i = 0; i < data.length; i++) {
                //if (data[i].responseHeaders['content-type'] == uniqueCon[k + 7]) { //fitler
                if (data[i].responseHeaders['cache-control']) { // Find the ttl with max-age
                    cacheControl = data[i].responseHeaders['cache-control'].split(", ");
                    for (j = 0; j < cacheControl.length; j++) {
                        if (cacheControl[j].match(/public|private|no-cache|no-store/)) {
                            histogramData.push(cacheControl[j]);
                        }
                    }
                }
                // }
            }
            console.log("histogramData");
            console.log(histogramData);

            let uniqueHist = [];
            for (i = 0; i < histogramData.length; i++) { // Find the unique values
                if (!uniqueHist.includes(histogramData[i])) {
                    uniqueHist.push(histogramData[i]);
                }
            }
            let freqHist = new Array(4).fill(0);
            for (i = 0; i < histogramData.length; i++) { // Find the frequency
                if (histogramData[i] == "public") {
                    freqHist[0] += 1;
                } else if (histogramData[i] == "private") {
                    freqHist[1] += 1;
                } else if (histogramData[i] == "no-cache") {
                    freqHist[2] += 1;
                } else if (histogramData[i] == "no-store") {
                    freqHist[3] += 1;
                }
            }
            console.log(uniqueHist);
            i = 0;
            for (i = 0; i < freqHist.length; i++) {
                if (freqHist[i] == 0) {
                    console.log(i);
                    freqHist.shift();
                    break;
                }
            }
            console.log(uniqueHist);
            console.log(freqHist);

            //var ctx = document.getElementById(canvas[k]).getContext('2d');
            var ctx = document.getElementById("myChart").getContext('2d');
            if (myChart) {
                myChart.destroy();
            }
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    //labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                    labels: uniqueHist,
                    datasets: [{
                        label: "Histogram",
                        //data: [12, 19, 3, 5, 2, 3],
                        data: freqHist,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255, 99, 132, 1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)'
                        ],
                        borderWidth: 1,
                        barPercentage: 1,
                        categoryPercentage: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true,
                            //type: "logarithmic",
                        }
                    }
                }
            });
            //})
        }
        // }
    });
</script>

<body>

</body>

</html>