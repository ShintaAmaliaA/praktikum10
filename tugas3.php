<?php
// Konfigurasi koneksi database
include('koneksi.php');

// Membuka koneksi ke database
$koneksi = mysqli_connect($host, $user, $password, $database);

// Memastikan koneksi berhasil
if (!$koneksi) {
    die("Koneksi database gagal: " . mysqli_connect_error());
}

// Query untuk mengambil data dari tabel
$sql = "SELECT country, total_cases, total_deaths, total_recovered, active_cases, total_tests FROM covid_data ORDER BY total_cases DESC LIMIT 10";

// Mendapatkan hasil query
$result = $koneksi->query($sql);

$countries = array();
$totalCases = array();
$totalDeaths = array();
$totalRecovered = array();
$activeCases = array();
$totalTests = array();

// Ambil semua baris hasil query dan simpan dalam array
while ($row = $result->fetch_assoc()) {
    $countries[] = $row['country'];
    $totalCases[] = $row['total_cases'];
    $totalDeaths[] = $row['total_deaths'];
    $totalRecovered[] = $row['total_recovered'];
    $activeCases[] = $row['active_cases'];
    $totalTests[] = $row['total_tests'];
}

// Menutup koneksi
$koneksi->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Data Covid</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
    <div style="width: 800px; height: 800px">
        <canvas id="pieChart"></canvas>
    </div>

    <div style="width: 800px; height: 800px">
        <canvas id="doughnutChart"></canvas>
    </div>

    <script>
        // Pie Chart
        var pieChartCtx = document.getElementById("pieChart").getContext('2d');
        var pieChart = new Chart(pieChartCtx, {
            type: 'pie',
            data: {
                labels: <?php echo json_encode($countries); ?>,
                datasets: [{
                    data: <?php echo json_encode($totalCases); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });

        // Doughnut Chart
        var doughnutChartCtx = document.getElementById("doughnutChart").getContext('2d');
        var doughnutChart = new Chart(doughnutChartCtx, {
            type: 'doughnut',
            data: {
                labels: <?php echo json_encode($countries); ?>,
                datasets: [{
                    data: <?php echo json_encode($totalCases); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(153, 102, 255, 0.5)',
                        'rgba(255, 159, 64, 0.5)',
                        'rgba(75, 192, 192, 0.5)',
                        'rgba(255, 99, 132, 0.5)',
                        'rgba(54, 162, 235, 0.5)',
                        'rgba(255, 206, 86, 0.5)'
                    ],
                    borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false
            }
        });
    </script>
</body>
</html>
