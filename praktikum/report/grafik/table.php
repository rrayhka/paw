<?php
    include("../koneksi.php");
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi");
    
    header("Content-type: application/vnd-ms-excel; charset=utf-8");
    header("Content-Disposition: attachment; filename=Laporan Pesanan.xls");
    $total = 0; 
    $queryTanggal = array(); 
    $arrPelanggan = array();
    $arrPendapatan = array();

    $tanggalA = $_GET["tanggalA"];
    $tanggalB = $_GET["tanggalB"];
    
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


?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script type="text/javascript" src="https://unpkg.com/xlsx@0.15.1/dist/xlsx.full.min.js"></script>
        <title>Grafik</title>
    </head>
    <body>

        <div class="container mt-4">
            <div class="card">
                <div class="card-body">
                    <h2 class="card-title text-center mb-4">Table Transaksi</h2>

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
    </body>
</html>

