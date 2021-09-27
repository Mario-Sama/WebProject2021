<?php
include_once 'header.php';
include_once 'includes/dbh.inc.php'
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $.ajax({
        url: 'AJAX/get_heatmap_data.php',
        method: 'GET',
        data: {
            name: "mariosss"
        },
        success: function(json) {
            var data = JSON.parse(json);
            console.log(data);
            let ttl = [];
            for (let i = 0; i < data.requestMethod.length; i++) {
                if (data.requestMethod[i] == "cache-control") {
                    ttl.push(data.requestUrl[i]);
                }
            }
            console.log(ttl);
        }
    });

    // var x = [];
    // for (var i = 0; i < 500; i++) {
    //     x[i] = Math.random();
    // }

    // var trace = {
    //     x: x,
    //     type: 'histogram',
    // };
    // var data = [trace];
    // Plotly.newPlot('myDiv', data);
</script>


<?php
// if (isset($_SESSION["useruid"])) {
// echo "<p>Hello " . $_SESSION["useruid"] . "<p>";
//}
?>



<?php
include_once 'footer.php'
?>