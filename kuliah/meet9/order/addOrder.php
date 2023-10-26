<?php
    $currentDate = date('Y-m-d');
    $currentTime = date('H:i:s');
    $currentTimeWIB = date('H:i:s', strtotime('+7 hours', strtotime($currentTime)));

?>


<!-- Rest of your HTML code -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WarungKU Menu</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="../menu/menu.php">WarungKU</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="../orderdetail/admin.php">Order Detail</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../order/order.php">Order</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../menu/menu.php">Menu</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container mt-3">
        <h1 class="mb-4">Order Pembeli</h1>
        <form action="prosesOrder.php" method="post">
            <div class="form-row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama">Nama Pembeli</label>
                        <input type="text" name="nama" id="nama" class="form-control" placeholder="Masukkan nama Anda">
                    </div>
                    <div class="form-group">
                        <label for="jenis_makanan">Jenis Makanan</label>
                        <select name="jenis_makanan" id="jenis_makanan" class="form-control">
                            <option value="" disabled selected>Silahkan pilih</option>
                            <option value="makanan">Makanan</option>
                            <option value="minuman">Minuman</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nama_makanan">Nama Makanan</label>
                        <select name="nama_makanan" id="nama_makanan" class="form-control">
                            <option value="" disabled selected>Silahkan pilih</option>
                            <?php
                                // Tampilkan nama menu menggunakan foreach
                                foreach ($menuItems as $item) {
                                    echo "<option value='$item'>$item</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="harga">Harga</label>
                        <input type="number" name="harga" id="harga" class="form-control" readonly>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nama_pelayan">Nama Pelayan</label>
                        <select name="nama_pelayan" id="nama_pelayan" class="form-control">
                            <option value="" disabled selected>Silahkan pilih</option>
                            <option value="adul">Adul</option>
                            <option value="komeng">Komeng</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nomor_meja">Nomor Meja</label>
                        <input type="number" name="nomor_meja" id="nomor_meja" class="form-control" placeholder="Masukkan nomor meja">
                    </div>
                    <div class="form-group">
                        <label for="tanggal">Tanggal</label>
                        <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?php echo $currentDate; ?>" readonly>
                    </div>
                    <div class="form-group">
                        <label for="jam">Jam</label>
                        <input type="time" name="jam" id="jam" class="form-control" value="<?php echo $currentTimeWIB; ?>" readonly>
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary" name="submit">Tambah Menu</button>
        </form>
    </div>
    <script>
        document.getElementById('jenis_makanan').addEventListener('change', function() {
                // AJAX request untuk mendapatkan nama menu berdasarkan jenis makanan
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'get_menu_by_category.php', true);
                xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
                
                // Callback function ketika AJAX request selesai
                xhr.onload = function() {
                if (xhr.status == 200) {
                    // Update select nama_makanan
                    var namaMenuSelect = document.getElementById('nama_makanan');
                    namaMenuSelect.innerHTML = xhr.responseText;
                }
            };
            
            // Kirim data jenis_makanan ke server
            var jenisMakananValue = this.value;
            var data = 'jenis_makanan=' + encodeURIComponent(jenisMakananValue);
            xhr.send(data);
        });

        document.getElementById('nama_makanan').addEventListener('change', function() {
        // AJAX request untuk mendapatkan informasi menu berdasarkan nama makanan
        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'get_menu_info.php', true);
        xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');

        // Callback function ketika AJAX request selesai
        xhr.onload = function() {
            if (xhr.status == 200) {
                // Parse JSON response
                var menuInfo = JSON.parse(xhr.responseText);

                // Update nilai pada elemen input harga
                var hargaInput = document.getElementById('harga');
                hargaInput.value = menuInfo.harga;
            }
        };

        // Kirim data nama_makanan ke server
        var namaMakananValue = this.value;
        var data = 'nama_makanan=' + encodeURIComponent(namaMakananValue);
        xhr.send(data);
    });

</script>
</body>
</html>
