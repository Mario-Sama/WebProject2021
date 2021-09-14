<!DOCTYPE html>
<html>
<head>
	<title>JSON in PHP and Javascript</title>
	<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js" type="text/javascript"></script>
</head>
<body>
    <h1> JSON in PHP and JS</h1>
    <h2> bs </h2>
</body>

<script type ="text/javascript">
    var emps = [];
    var emp1= {};
    var emp2 = {};

    emp1.id = 1;
    emp1.name = 'Durgesh';
    emp1.addr = 'Pune';
    emps.push(emp1);

    emp2.id = 2;
    emp2.name = 'Rakesh';
    emp2.addr = 'Mumbai';
    emps.push(emp2);

     console.log(emps)
     $.ajax({
         url:"readJson.php",
         method: "post",
         data: emp1,
         success: function(res) {
             console.log(res);
         }
    })
</script>
</html>