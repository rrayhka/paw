<?php
    include("../koneksi.php");
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi");

    $total = 0; 
    $queryTanggal = array(); 
    $arrPelanggan = array();
    $arrPendapatan = array();

    if(isset($_POST["submit"])){
        $tanggalA = $_POST["tanggalA"];
        $tanggalB = $_POST["tanggalB"];
        
        $transaksi = mysqli_query(
            $koneksi, 
            "SELECT id, waktu_transaksi, sum(total) AS total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB' GROUP BY waktu_transaksi"
        );
        $queryTanggal = $transaksi ? mysqli_fetch_all($transaksi, MYSQLI_ASSOC) : array();

        $jumlahPelanggan = mysqli_query(
            $koneksi, 
            "SELECT COUNT(DISTINCT pelanggan_id) AS total_pelanggan
            FROM transaksi
            WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB';"
            );
        $arrPelanggan = $jumlahPelanggan ? mysqli_fetch_all($jumlahPelanggan, MYSQLI_ASSOC) : array();
        

        $queryJumlahPendapatan = mysqli_query(
                $koneksi, 
                "SELECT sum(total) AS total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB'"
        );
        $arrPendapatan = $queryJumlahPendapatan ? mysqli_fetch_all($queryJumlahPendapatan, MYSQLI_ASSOC) : array();
        
    }

    
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <style type="text/css">
            @media print{
                .no-print, .no-print *{
                    display: none !important;
                }
            }

        </style>
        <title>Grafik</title>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="barang.php">Praktikum</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="../grafik/index.php">Grafik</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../transaksi/transaksi.php">Transaksi</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../suplier/suplier.php">Suplier</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../barang/barang.php">Barang</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="https://github.com/rrayhka" target="_blank">
                                <i class="bi bi-github">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-github" viewBox="0 0 16 16">
                                        <path d="M8 0C3.58 0 0 3.58 0 8c0 3.54 2.29 6.53 5.47 7.59.4.07.55-.17.55-.38 0-.19-.01-.82-.01-1.49-2.01.37-2.53-.49-2.69-.94-.09-.23-.48-.94-.82-1.13-.28-.15-.68-.52-.01-.53.63-.01 1.08.58 1.23.82.72 1.21 1.87.87 2.33.66.07-.52.28-.87.51-1.07-1.78-.2-3.64-.89-3.64-3.95 0-.87.31-1.59.82-2.15-.08-.20-.36-1.02.08-2.12 0 0 .67-.21 2.20.82.64-.18 1.32-.27 2.00-.27.68 0 1.36.09 2.00.27 1.53-1.04 2.20-.82 2.20-.82.44 1.10.16 1.92.08 2.12.51.56.82 1.27.82 2.15 0 3.07-1.87 3.75-3.65 3.95.29.25.54.73.54 1.48 0 1.07-.01 1.93-.01 2.20 0 .21.15.46.55.38A8.012 8.012 0 0 0 16 8c0-4.42-3.58-8-8-8z"/>
                                    </svg>
                                </i>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Grafik Transaksi</h2>
                    <form method="post" class="form-inline justify-content-center mb-4 no-print">
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="date" name="tanggalA" id="tanggalA" class="form-control" required>
                        </div>
                        <div class="form-group mx-sm-3 mb-2">
                            <input type="date" name="tanggalB" id="tanggalB" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>

                    <div class="d-flex mb-3">
                        <button name="print" onclick="pagePrint()" class="btn btn-secondary mr-3 no-print">Print</button>
                        <a href="table.php?tanggalA=<?= isset($tanggalA) ? $tanggalA : '' ?>&tanggalB=<?= isset($tanggalB) ? $tanggalB : '' ?>">
                            <button type="button" class="btn btn-success no-print">Export to Excel</button>
                        </a>
                    </div>

                    <div class="chart-container" style="width: 100%;">
                        <canvas id="myChart"></canvas>
                    </div>

                    <table class="table mt-3">
                        <thead class="thead-dark">
                            <th>No</th>
                            <th>Total</th>
                            <th>Tanggal</th>
                        </thead>
                        <tbody>
                            <?php
                                $no = 1;
                                if(is_array($queryTanggal) && count($queryTanggal) > 0) {
                                    foreach($queryTanggal as $data){
                                        $total += $data["total"];
                            ?>
                            <tr>
                                <td><?= $no++ ?></td>
                                <td><?= "Rp " . number_format($data["total"]) ?></td>
                                <td><?= $data["waktu_transaksi"] ?></td>
                            </tr>
                            <?php
                                    }
                                } else {
                                    echo "<tr><td colspan='3'>Tidak ada data</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>

                    <table class="table">
                        <thead class="thead-dark">
                            <th>Jumlah Pelanggan</th>
                            <th>Total Pendapatan</th>
                        </thead>
                        <tbody>
                            <?php
                                if(isset($arrPelanggan[0]) && isset($arrPendapatan[0])) {
                            ?>
                            <tr>
                                <td><?= $arrPelanggan[0]["total_pelanggan"] ?></td>
                                <td><?= "Rp " . number_format($arrPendapatan[0]["total_pendapatan"]) ?></td>
                            </tr>
                            <?php
                                } else {
                                    echo "<tr><td colspan='2'>Tidak ada data</td></tr>";
                                }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <script>
            const ctx = document.getElementById('myChart');
            const data = {
                labels: <?= json_encode(array_column($queryTanggal, 'waktu_transaksi')) ?>,
                datasets: [{
                    label: 'Total',
                    data: <?= json_encode(array_column($queryTanggal, 'total')) ?>,
                    borderColor: 'green',
                    backgroundColor: 'grey',
                }]
            };

            const config = {
                type: 'bar',
                data: data,
                options: {
                    responsive: true,
                    plugins: {
                        legend: {
                            position: 'top',
                        },
                        title: {
                            display: false,
                            text: 'Chart.js Bar Chart'
                        }
                    }
                },
            };
            new Chart(ctx, config);

            function pagePrint() {
                window.print();
            }
        </script>
    </body>
</html>

