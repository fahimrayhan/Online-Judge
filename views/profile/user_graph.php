<?php 

	$lastSubmissionData=array();
?>

<script>

window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,  
	title:{
		text: "Last 10 Days Submission"
	},
	axisY: {
		
		suffix: "",
		prefix: "",
		gridThickness: 0
	},
	axisX:{
   		valueFormatString: "DD MMM",
 	},
	data: [{
		type: "splineArea",
		color: "#2C3542",
		markerSize: 7,
		xValueFormatString: "DD MMM YYYY ",
		yValueFormatString: "#,##0.##",
		dataPoints: [
			{ x: new Date(1999, 11, 30), y: 7 },
			{ x: new Date(1999, 11, 31), y: 7 },
			{ x: new Date(2000, 0, 1), y: 15 },
			{ x: new Date(2000, 0, 2), y: 1 },
			{ x: new Date(2000, 0, 3), y: 2 },
			{ x: new Date(2000, 0, 4), y: 5 },
			{ x: new Date(2000, 0, 5), y: 3 },
			{ x: new Date(2000, 0, 6), y: 7 },
			{ x: new Date(2000, 0, 7), y: 7 },
			{ x: new Date(2000, 0, 8), y: 7 },
			{ x: new Date(2000, 0, 9), y: 7 }
			
		]
	}]
	});
chart.render();

}
</script>
</head>
<body>
<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>