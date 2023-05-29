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
    <title>Line Chart Covid</title>
    <script type="text/javascript" src="Chart.js"></script>
</head>
<body>
    <div style="width: 800px; height: 800px">
        <canvas id="lineChart"></canvas>
    </div>
    <script>
        // Line Chart
        var lineChartCtx = document.getElementById("lineChart").getContext('2d');
        var lineChart = new Chart(lineChartCtx, {
            type: 'line',
            data: {
                labels: <?php echo json_encode($countries); ?>,
                datasets: [
                    {
                        label: 'Total Cases',
                        data: <?php echo json_encode($totalCases); ?>,
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255,99,132,1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Deaths',
                        data: <?php echo json_encode($totalDeaths); ?>,
                        backgroundColor: 'rgba(54, 162, 235, 0.2)',
                        borderColor: 'rgba(54, 162, 235, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Recovered',
                        data: <?php echo json_encode($totalRecovered); ?>,
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Active Cases',
                        data: <?php echo json_encode($activeCases); ?>,
                        backgroundColor: 'rgba(255, 206, 86, 0.2)',
                        borderColor: 'rgba(255, 206, 86, 1)',
                        borderWidth: 1
                    },
                    {
                        label: 'Total Tests',
                        data: <?php echo json_encode($totalTests); ?>,
                        backgroundColor: 'rgba(153, 102, 255, 0.2)',
                        borderColor: 'rgba(153, 102, 255, 1)',
                        borderWidth: 1
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
</body>
</html>
