<?php
    include("../koneksi.php");
    $query = mysqli_query($koneksi, "SELECT * FROM transaksi");

    $total = 0; 
    $queryTanggal = array(); 

    if(isset($_POST["submit"])){
        $tanggalA = $_POST["tanggalA"];
        $tanggalB = $_POST["tanggalB"];
        
        $transaksi = mysqli_query(
            $koneksi, 
            "SELECT id, waktu_transaksi, sum(total) AS total FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB' GROUP BY waktu_transaksi"
        );
        $queryTanggal = $transaksi ? mysqli_fetch_all($transaksi, MYSQLI_ASSOC) : array();

        $jumlahPelanggan = mysqli_fetch_all(
            mysqli_query($koneksi, 
            "SELECT pelanggan_id, COUNT(DISTINCT pelanggan_id) AS jumlah_pelanggan
            FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB' GROUP BY pelanggan_id"
            ), MYSQLI_ASSOC
        );
        $queryJumlahPendapatan = mysqli_fetch_all(
            mysqli_query(
                $koneksi, 
                "SELECT sum(total) AS total_pendapatan FROM transaksi WHERE waktu_transaksi BETWEEN '$tanggalA' AND '$tanggalB'"
            ),
            MYSQLI_ASSOC
        );
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <title>Document</title>
    </head>
    <body>
        <div class="container mt-3">
            <div>
                <form method="post">
                    <input type="date" name="tanggalA" id=""><br>
                    <input type="date" name="tanggalB" id="">
                    <button type="submit" name="submit">Submit</button>
                </form>
            </div>
            <div style="width: 40%; height: 50%;">
                <canvas id="myChart"></canvas>
            </div>
            <table>
                <thead>
                    <th>No</th>
                    <th>Total</th>
                    <th>Tanggal</th>
                </thead>
                <tbody>
                    <?php
                        $no = 1;
                        // Check if $queryTanggal is not null and is an array
                        if(is_array($queryTanggal) && count($queryTanggal) > 0) {
                            foreach($queryTanggal as $data){
                                $total += $data["total"];
                    ?>
    
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $data["total"] ?></td>
                        <td><?= $data["waktu_transaksi"] ?></td>
                    </tr>
                    <?php
                            }
                        } else {
                            echo "<tr><td colspan='3'>No data available</td></tr>";
                        }
                    ?>
                </tbody>
            </table>
            <table>
                <thead>
                    <th>Jumlah Pelanggan</th>
                    <th>Total Pendapatan</th>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <?php
                                if(isset($jumlahPelanggan[0]["jumlah_pelanggan"])){
                                    echo $jumlahPelanggan[0]["jumlah_pelanggan"];
                                } else {
                                    echo "0";
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if(isset($queryJumlahPendapatan[0]["total_pendapatan"])){
                                    echo $queryJumlahPendapatan[0]["total_pendapatan"];
                                } else {
                                    echo "0";
                                }
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </body>
    <script>
        const ctx = document.getElementById('myChart');
        const data = {
            labels: [

            ],
            datasets: [{
                label: 'Total',
                data: [

                ],
                borderColor: 'blue',
                backgroundColor: 'blue',
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
                        display: true,
                        text: 'Chart.js Bar Chart'
                    }
                }
            },
        };

        new Chart(ctx, config);
    </script>
</html>
