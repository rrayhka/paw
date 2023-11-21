<?php 
    require 'koneksi.php';
    $level = [
        1 => "Admin",
        2 => "User Biasa"
    ];
    if(isset($_POST['register'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $password2 = $_POST['password2'];
        $nama = $_POST['nama'];
        $alamat = $_POST['alamat'];
        $nomor = $_POST['nomor'];
        $level = $_POST['level'];
        if($password == $password2){
            $sql = "INSERT INTO user (username, password, nama, alamat, hp, level) VALUES (:username, :password, :nama, :alamat, :hp, :level)";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(':username', $username);
            $stmt->bindParam(':password', password_hash($password, PASSWORD_BCRYPT));
            $stmt->bindParam(':nama', $nama);
            $stmt->bindParam(':alamat', $alamat);
            $stmt->bindParam(':hp', $nomor);
            $stmt->bindParam(':level', $level);
            $stmt->execute();
            header("Location: login.php");
        }else{
            echo "Password tidak sama";
        }
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
