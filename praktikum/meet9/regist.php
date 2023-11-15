<?php 
    require 'koneksi.php';
    $tableUser = mysqli_query($koneksi, "SELECT * FROM user");
    $level = [
        1 => "Admin",
        2 => "User Biasa"
    ];
    if( isset($_POST["register"]) ) {
        $username = strtolower(stripslashes($_POST["username"]));
        $password = mysqli_real_escape_string($koneksi, $_POST["password"]);
        $password2 = mysqli_real_escape_string($koneksi, $_POST["password2"]);
        $nama = htmlspecialchars($_POST["nama"]);
        $alamat = htmlspecialchars($_POST["alamat"]);
        $nomor = htmlspecialchars($_POST["nomor"]);
        $level = htmlspecialchars(($_POST["level"]));
        var_dump(
            $username, $password, $password2, $nama, $alamat, $nomor, $level
        );
        $cekUsername = mysqli_query(
            $koneksi, 
            "SELECT username FROM user WHERE username = '$username'"
        );
        if(mysqli_fetch_assoc($cekUsername)){
            echo 
                "<script>
                    alert('username sudah terdaftar!')
                </script>";
            exit; 
        }

        if( $password !== $password2 ) {
            echo 
                "<script>
                    alert('konfirmasi password tidak sesuai!');
                </script>";
            exit; 
        }
        $password = password_hash($password, PASSWORD_DEFAULT); 
        $result = mysqli_query(
            $koneksi, 
            "INSERT INTO user (id_user, username, password, nama, alamat, hp, level) VALUES
            ('', '$username', '$password', '$nama', '$alamat', '$nomor', '$level')"
        );
            
    }
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Halaman Registrasi</title>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    </head>
    <body class="container">
        <h1>Halaman Registrasi</h1>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" class="form-control" name="username" id="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" class="form-control" name="password" id="password" required>
            </div>
            <div class="form-group">
                <label for="password2">Konfirmasi Password:</label>
                <input type="password" class="form-control" name="password2" id="password2" required>
            </div>
            <div class="form-group">
                <label for="nama">Nama User:</label>
                <input type="text" class="form-control" name="nama" required>
            </div>
            <div class="form-group">
                <label for="alamat">Alamat:</label>
                <textarea class="form-control" name="alamat" id="alamat" rows="4" required></textarea>
            </div>
            <div class="form-group">
                <label for="nomor">Nomor HP:</label>
                <input type="text" class="form-control" name="nomor" required>
            </div>
            <div class="form-group">
                <label for="level">Silahkan Jenis Level:</label>
                <select class="form-control" name="level" id="level" required>
                    <option value="" disabled selected>Silahkan Jenis Level</option>
                    <?php foreach($level as $key => $value) : ?>
                        <option value="<?php echo $key ?>"><?php echo $value ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <button type="submit" class="btn btn-primary" name="register">Register!</button>
        </form>
    </body>
</html>
