<?php
include 'db_conn.php';
?>
<!DOCTYPE HTML>
<html>
	<head>
		<title>Punuka Library App</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=no" />
		<link rel="stylesheet" href="assets/css/main.css" />
		<link rel="stylesheet" href="assets/css/style.css" />
		<script src="assets/js/jquery.min.js"></script>
		<script src="highcharts/highcharts.js"></script>
		<script src="highcharts/themes/sand-signinka.js"></script>
		<script src="highcharts/modules/exporting.js"></script>
	</head>
	<body>
<script type="text/javascript">
$(function () {
var chart;
$(document).ready(function() {
$.getJSON("graphs/borrowed.php", function(json) {
chart = new Highcharts.Chart({
chart: {
renderTo: 'stock',
type: 'column',
marginRight: 130,
marginBottom: 25,
},
credits:{
    enabled:false
},
title: {
text: '',
x: -20 //center
},
subtitle: {
text: '',
x: -20
},
xAxis: {
categories: ['Books']
},
yAxis: {
title: {
text: ''
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
tooltip: {
formatter: function() {
return this.series.name+': <b>'+ this.y+'</b>';
}
},
title:{
    text: 'Library stock and Borrowed books'
},
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -10,
y: 100,
borderWidth: 0
},
series: json
});
});
 
});
 
});
</script>
<div id="borrowed" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="stock" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<div id="staff" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
<script type="text/javascript">
Highcharts.chart('borrowed', {
    chart: {
        type: 'column'
    },
    title: {
        text: 'Borrowers of Over-due Books'
    },
    subtitle: {
        text: ''
    },credits:{
    enabled:false
},
    xAxis: {
        categories: [
                <?php 
                    $query = $mysqli->query("SELECT distinct staff_id FROM borrowers");
                    while ($rows = $query->fetch_assoc()) {
                        $staff_id = $rows['staff_id'];
                ?>
                '<?=$rows['staff_id']?>',
                <?php
            }
            ?>
                ]
    },
    yAxis: {
        title: {
            text: ''
        },
        allowDecimals: false
    },

    plotOptions: {
        line: {
            dataLabels: {
                enabled: true
            },
            enableMouseTracking: false
        }
    },
    series: [{name: 'Over-due books',
        data: [
        <?php
            $query1 = $mysqli->query("SELECT distinct staff_id FROM BORROWERS WHERE (NOW()>due_date)");
            while ($rows2 = $query1->fetch_assoc()) {
            $staff= $rows2['staff_id'];
            $query2 = $mysqli->query("SELECT staff_id FROM BORROWERS WHERE staff_id = '$staff' and (NOW()>due_date)");
            $borrowed = $query2->num_rows;
    ?>
    <?=$borrowed?>,
<?php
    }
    ?>
        ]
    }]
});
        </script>
        <script type="text/javascript">
$(function () {
var chart;
$(document).ready(function() {
$.getJSON("graphs/overdue.php", function(json) {
chart = new Highcharts.Chart({
chart: {
renderTo: 'staff',
type: 'column',
marginRight: 130,
marginBottom: 25,
},
credits:{
    enabled:false
},
title: {
text: '',
x: -20 //center
},
subtitle: {
text: '',
x: -20
},
xAxis: {
categories: ['Staff']
},
yAxis: {
title: {
text: ''
},
plotLines: [{
value: 0,
width: 1,
color: '#808080'
}]
},
tooltip: {
formatter: function() {
return this.series.name+': <b>'+ this.y+'</b>';
}
},
title:{
    text: 'Library Users'
},
legend: {
layout: 'vertical',
align: 'right',
verticalAlign: 'top',
x: -10,
y: 100,
borderWidth: 0
},
series: json
});
});
 
});
 
});
</script>
		</script>