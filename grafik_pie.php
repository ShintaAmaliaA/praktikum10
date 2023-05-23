<?php
include('koneksi.php');

$data = [
    ['Country', 'Total Cases'],
    ['India', 44986461],
    ['Japan', 33803572],
    ['S. Korea', 31548083],
    ['Turkey', 17232066],
    ['Vietnam', 11602738],
    ['Taiwan', 10239998],
    ['Iran', 7611224],
    ['Indonesia', 6802090],
    ['Malaysia', 5088009],
    ['Israel', 4824551]
];

$countryData = [];
$totalCasesData = [];

foreach ($data as $row) {
    $countryData[] = $row[0];
    $totalCasesData[] = $row[1];
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Pie Chart</title>
<script type="text/javascript" src="Chart.js"></script>
</head>
<body>
<div style="width: 800px;height: 800px">
<canvas id="myChart"></canvas>
</div>

<script>
var ctx = document.getElementById("myChart").getContext('2d');
var myChart = new Chart(ctx, {
type: 'pie',
data: {
labels: <?php echo json_encode($countryData); ?>,
datasets: [{
label: 'Total Cases',
data: <?php echo json_encode($totalCasesData); ?>,
backgroundColor: [
'rgba(255, 99, 132, 0.2)',
'rgba(54, 162, 235, 0.2)',
'rgba(255, 206, 86, 0.2)',
'rgba(75, 192, 192, 0.2)',
'rgba(153, 102, 255, 0.2)',
'rgba(255, 159, 64, 0.2)',
'rgba(255, 0, 0, 0.2)',
'rgba(0, 255, 0, 0.2)'
],
borderColor: [
'rgba(255, 99, 132, 1)',
'rgba(54, 162, 235, 1)',
'rgba(255, 206, 86, 1)',
'rgba(75, 192, 192, 1)',
'rgba(153, 102, 255, 1)',
'rgba(255, 159, 64, 1)',
'rgba(255, 0, 0, 1)',
'rgba(0, 255, 0, 1)'
],
borderWidth: 1
}]
},
options: {
responsive: true,
legend: {
position: 'top',
},
title: {
display: true,
text: 'Pie Chart - Total Cases by Country'
},
animation: {
animateScale: true,
animateRotate: true
}
}
});
</script>
</body>
</html>
