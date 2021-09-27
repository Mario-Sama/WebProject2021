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
        width: 1000px;
    }
</style>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/css/select2.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.0/js/select2.min.js"></script>

<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>

<?php
if (!isset($_SESSION['useruid']) || $_SESSION['isAdmin'] != 1) {
    header('Location: index.php');
}
?>

<div class="chartBox">
    <canvas id="myChart"></canvas>
</div>


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
    $.ajax({
        url: 'AJAX/get_heatmap_data.php',
        method: "GET",
        data: {
            name: "mariosss"
        },
        success: function(json) {
            //console.log(json);
            var data = JSON.parse(json);
            console.log(data);
            //console.log(data[0]);
            //console.log(typeof(data[0].requestHeaders));
            let histogramData = [];
            let contentType = [];

            for (i = 0; i < data.length; i++) {
                if ("content-type" in data[i].responseHeaders) { // Find all content types
                    contentType.push(data[i].responseHeaders['content-type']);
                } //else if (newHar[i].responseHeadersName.includes('expires'))
            }
            //console.log(contentType);
            const tempCon = [];
            for (i = 0; i < contentType.length; i++) {
                let temp = contentType[i].split(';');
                tempCon.push(temp[0]);
            }

            const uniqueCon = [];
            const freqCon = [];
            j = -1;
            for (i = 0; i < tempCon.length; i++) { // Find the frequency and the of each value
                if (!uniqueCon.includes(tempCon[i])) {
                    uniqueCon.push(tempCon[i]);
                    freqCon.push(1);
                    j++;
                } else {
                    freqCon[j]++;
                }
            }
            console.log("unique");
            console.log(uniqueCon);
            console.log("frequency");
            console.log(freqCon);
            console.log("type");
            const d = [];
            for (i = 0; i < data.length; i++) {
                if (data[i].requestHeaders) { // Find the ttl with max-age
                    d.push(data[i].requestHeaders);
                }
            }
            console.log(d);
            let cacheControl = []; // Contains the cache controll directives
            let maxAge = []; // Contains the max-age
            for (i = 0; i < data.length; i++) {
                //if (data[i].responseHeaders['content-type'] == uniqueCon[10]) {   //fitler
                if (data[i].responseHeaders['cache-control']) { // Find the ttl with max-age
                    cacheControl = data[i].responseHeaders['cache-control'].split(",");
                    for (j = 0; j < cacheControl.length; j++) {
                        if (cacheControl[j].match(/max-age/)) {
                            histogramData.push(parseInt(cacheControl[j].replace(/\D/g, "")));
                        }
                    }
                }
            }
            let expires;
            let lastMod;
            for (i = 0; i < data.length; i++) {
                if (data[i].responseHeaders['expires']) { // Find the ttl from expires and startedDateTime
                    expires = new Date(data[i].responseHeaders['expires']);
                    lastMod = new Date(data[i].responseHeaders['startedDateTime']);
                    histogramData.push(expires - lastMod);
                }
            }
            histogramData = histogramData.filter(function(value) {
                return !Number.isNaN(value);
            });

            histogramData = histogramData.sort(function(a, b) { // Sort the histogram data
                return a - b;
            });
            const start = []; // Starting of the bin
            const end = []; // Ending of the bin
            end.push(histogramData[0] + (histogramData[histogramData.length - 1] - histogramData[0]) / 10);
            for (i = 0; i < 9; i++) { // Constract the start and the end of each bin
                end.push(end[i] + (histogramData[histogramData.length - 1] - histogramData[0]) / 10);
                start.push(end[i] - (histogramData[histogramData.length - 1] - histogramData[0]) / 10);
            }
            start.push(histogramData[histogramData.length - 1] - (histogramData[histogramData.length - 1] - histogramData[0]) / 10);
            console.log("start");
            console.log(start);
            console.log("end");
            console.log(end);
            console.log(histogramData);
            console.log(typeof(end[i].toString()));
            const bins = [];
            for (i = 0; i < 10; i++) { // Constract the bin labels
                bins.push(start[i].toString().concat('sec-', end[i].toString(), 'sec'));
            }
            console.log(bins);
            const uniqueHist = [];
            const freqHist = [];
            j = -1;
            for (i = 0; i < histogramData.length; i++) { // Find the frequency and the of each value
                if (!uniqueHist.includes(histogramData[i])) {
                    uniqueHist.push(histogramData[i]);
                    freqHist.push(1);
                    j++;
                } else {
                    freqHist[j]++;
                }
            }
            //console.log(uniqueHist);
            //console.log(freqHist);

            const binFreq = new Array(10).fill(0);

            // for (i = 0; i < binFreq.length; i++) {
            //     binFreq.push(0);
            // }
            console.log(binFreq);
            for (i = 0; i < histogramData.length; i++) {
                for (j = 0; j < end.length; j++) {
                    if (histogramData[i] <= end[j]) {
                        binFreq[j] = binFreq[j] + 1;
                        break;
                    }
                }
            }
            console.log(binFreq);
            var ctx = document.getElementById('myChart').getContext('2d');
            var myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: bins,
                    datasets: [{
                        label: 'ttl',
                        data: binFreq,
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
                        }
                    }
                }
            });
        }
    });
</script>

<body>

</body>

</html>