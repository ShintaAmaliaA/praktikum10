<?php
include('koneksi.php');
$jumlah  = mysqli_query($koneksi, "SELECT total_recovered FROM covid_data");
$country  = mysqli_query($koneksi, "SELECT country FROM covid_data");
?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>GRAFIK DOUGHNUT TOTAL RECOVER COVID-19</title>
    <script src="Chart.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    <style type="text/css">
    body {
        padding-top: 4%;
    }

    .container {
        width: 35%;
        margin: 15px auto;
    }
    </style>
</head>

<body>
    <center>
        <h2>GRAFIK DOUGHNUT COVID-19</h2>
    </center>
    <center>
        <h2>"TOTAL RECOVER"</h2>
    </center>
    <div class="container">
        <canvas id="doughnutchart" width="100" height="100"></canvas>
    </div>
</body>

</html>

<script type="text/javascript">
var ctx = document.getElementById("doughnutchart").getContext("2d");
var data = {
    labels: [<?php while ($p = mysqli_fetch_array($country)) { echo '"' . $p['country'] . '",';}?>],
    datasets: [{
        data: [
            <?php while ($p = mysqli_fetch_array($jumlah)) { echo '"' . $p['total_recovered'] . '",';}?>
        ],
        backgroundColor: [
            'rgba(255, 99, 132, 0.2)',
            'rgba(54, 162, 235, 0.2)',
            'rgba(255, 206, 86, 0.2)',
            'rgba(75, 192, 192, 0.2)',
            'rgba(133, 196, 155, 0.2)',
            'rgba(93, 33, 148, 0.2)',
            'rgba(117, 48, 15, 0.2)',
            'rgba(20, 4, 160, 0.2)',
            'rgba(234, 214, 77, 0.2)',
            'rgba(50, 96, 17, 0.2)'
        ],
        borderColor: [
            'rgba(255,99,132,1)',
            'rgba(54, 162, 235, 1)',
            'rgba(255, 206, 86, 1)',
            'rgba(75, 192, 192, 1)',
            'rgba(133, 196, 155, 1)',
            'rgba(93, 33, 148, 1)',
            'rgba(117, 48, 15, 1)',
            'rgba(20, 4, 160, 1)',
            'rgba(234, 214, 77, 1)',
            'rgba(50, 96, 17, 1)'
        ],
        label: 'Presentase Kasus Covid-19',
    }]
};
var mydoughnutchart = new Chart(ctx, {
    type: 'doughnut',
    data: data,
    options: {
        responsive: true
    }
});
</script>