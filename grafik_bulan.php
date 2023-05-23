<?php
include('koneksi.php');
$label = ["India", "Japan", "S. Korea", "Turkey", "Vietnam", "Taiwan", "Iran", "Indonesia", "Malaysia", "Israel"];
$total_cases = [44986461, 33803572, 31548083, 17232066, 11602738, 10239998, 7611224, 6802090, 5088009,4824551];
$total_deaths = [531832, 74694, 34687, 102174, 43203, 19005, 146236, 161674, 37046,12509];
$total_recovered = [44446514, null, 31198069, null, 10635065, 10220993, 7364870, 6625209, 5029873, 4798473];
$active_cases = [8115, null, 315327, null, 924470, 0, 100118, 15207,21090, 13569];
$total_tests = [929430169, 100414883, 15804065, 162743369, 85826548, 30742304, 56596583, 114158919, 68352292, 41373364];
$population = [1406631776, 125584838, 51329899, 85561976, 98953541, 23888595, 86022837, 279134505, 33181072, 9326000];
?>

<!DOCTYPE html>
<html>
<head>
<title>Membuat Grafik Menggunakan Chart JS</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width: 800px;height: 800px">
<canvas id="myChart"></canvas>
</div>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'bar',
data: {
labels: <?php echo json_encode($label); ?>,
datasets: [
{
label: 'Total Cases',
data: <?php echo json_encode($total_cases); ?>,
backgroundColor: 'rgba(255, 99, 132, 0.2)',
borderColor: 'rgba(255,99,132,1)',
borderWidth: 1
},
{
label: 'Total Deaths',
data: <?php echo json_encode($total_deaths); ?>,
backgroundColor: 'rgba(54, 162, 235, 0.2)',
borderColor: 'rgba(54, 162, 235, 1)',
borderWidth: 1
},
{
label: 'Total Recovered',
data: <?php echo json_encode($total_recovered); ?>,
backgroundColor: 'rgba(75, 192, 192, 0.2)',
borderColor: 'rgba(75, 192, 192, 1)',
borderWidth: 1
},
{
label: 'Active Cases',
data: <?php echo json_encode($active_cases); ?>,
backgroundColor: 'rgba(255, 206, 86, 0.2)',
borderColor: 'rgba(255, 206, 86, 1)',
borderWidth: 1
}
]
},
options: {
scales: {
yAxes: [{
ticks: {
beginAtZero:true
}
}]
}
}
});
</script>
</body>
</html>
