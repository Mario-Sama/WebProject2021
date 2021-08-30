var xmlhttp = new XMLHttpRequest();
//var url = "http://localhost/admin/charts/example.json";
var url = "http://localhost/admin/charts/harNEEDEDONLY.json";

xmlhttp.open("GET", url, true);
xmlhttp.send();
xmlhttp.onreadystatechange  = function(){
    if(this.readyState == 4 && this.status == 200) {
        var data = JSON.parse(this.responseText);
        //console.log(data)
        // var months = data.months_temperature.map(function(elem){
        //     return elem.date;
        // });
        // //console.log(months)
        // var high = data.months_temperature.map(function(elem){
        //     return elem.high;
        // });var low = data.months_temperature.map(function(elem){
        //     return elem.low;
        //});
        var timings = data.log.entries.map(function(elem) {
            return elem.timings.wait;
        });
        console.log(timings);

        var datetime = data.log.entries.map(function(elem) {
            return elem.startedDateTime;
        });

        console.log(datetime);
        //var times = datetime.toString().substr(11, 8);
        var times = JSON.stringify(datetime);
        console.log(times);
        console.log(times.substr(13,2));
       // var times2 = JSON.parse('times');
        //console.log(times2);

        
        objnum = Object.keys(datetime).length; //number of objects
        console.log(objnum);
        skipchars = 0;
        timesboad = [];
        for (let i = 0; i < objnum; i++) { //for the number of objects o will keep only the times i want and then i parse
            hour = times.substr(13+skipchars,2);   
            skipchars = skipchars + 27;
            timesboad = timesboad + hour;
        };
        console.log(timesboad);
        //usedhours = JSON.parse(timesboad);
        //meso oro gia kathe ora kai meta dataset gia afto me 24 theseis kai antistoixo meso oro gia kathe ora se kathe thesi
        var hoursofday = [01,02,03,04,05,06,07,08,09,10,11,12,13,14,15,16,17,18,19,20,21,22,23,24]

        var ctx = document.getElementById('canvas').getContext('2d'); //getelementbyId apo to id pou exei dothei sto canvas apo to html
        var myChart = new Chart(ctx, {
            type: 'line', //prin itan bars 
            data: {
                //labels: months,
                labels: hoursofday,
                datasets: [
                    // {
                    //     label: 'High Temperature', //the label of the ypomnima
                    //     data: high,
                    //     backgroundColor: 'transparent',
                    //     borderColor: 'red',
                    //     borderWidth: 4
                    // },
                    // {
                    //     label: 'Low Temperature', //the label of the ypomnima
                    //     data: low,
                    //     backgroundColor: 'transparent',
                    //     borderColor: 'green',
                    //     borderWidth: 4
                    // }
                    {
                        label: 'Waiting Time',
                        data: timings,
                        backgroundColor: 'transparent',
                        borderColor: 'red',
                        borderWidth: 4
                    }
                ]
            },
            options: {
                elements: {
                    line:{
                        tension:0
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    }
}