<?php 
 
include '../koneksi.php';
 
error_reporting(0);
 
if (isset($_SESSION['username'])) {
    header("Location: register.php");
}
 
if (isset($_POST['submit'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $alamat_pelanggan = $_POST['alamat_pelanggan'];
    $no_ktp = $_POST['no_ktp'];
    $telp_pelanggan = $_POST['telp_pelanggan'];
    $jenis_kelamin = $_POST['jenis_kelamin'];

    if ($password == $cpassword) {
        $sql = "SELECT * FROM pelanggan WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO pelanggan (nama_pelanggan, username, password, alamat_pelanggan, no_ktp, telp_pelanggan, jenis_kelamin)
            values ('$nama_pelanggan', '$username', '$password', '$alamat_pelanggan', '$no_ktp', '$telp_pelanggan', '$jenis_kelamin')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $name_pelanggan = "";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
                $alamat_pelanggan = "";
                $jenis_kelamin = "";
                $telp_pelanggan = "";
                $no_ktp = "";
                
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! Username Sudah Terdaftar.')</script>";
        }
         
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}
 
?>
 
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
 
    <link rel="stylesheet" type="text/css" href="style.css">
 
    <title>Rancabana Register</title>
</head>
<body>
    <div class="container">
    <form action="" method="POST" class="login-email">
            <p class="login-text" style="font-size: 2rem; font-weight: 800;">Register</p>
            <div class="input-group">
                <input type="text" placeholder="nama pelanggan" name="nama_pelanggan" id="nama_pelanggan" value="<?php echo $nama_pelanggan; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="username" name="username" id="username" value="<?php echo $username; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="password" name="password" id="password" value="<?php echo $password; ?>" required>
            </div>
            <div class="input-group">
                <input type="password" placeholder="konfirmasi password" name="cpassword" id="cpassword" value="<?php echo $cpassword; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="alamat pelanggan" name="alamat_pelanggan" id="alamat_pelanggan" value="<?php echo $alamat_pelanggan; ?>" required>
            </div>
            <div class="input-group">
            <label for="defaultSelect">Jenis Kelamin</label>
                <select name="jenis_kelamin" class="form-control form-control" id="jenis_kelamin" value="<?php echo $jenis_kelamin; ?>" required>
                    <option value="L">Laki-laki</option>
                    <option value="P">Perempuan</option>
                </select>
            </div>
            <div class="input-group">
                <input type="text" placeholder="telp pelanggan" name="telp_pelanggan" id="telp_pelanggan" minlength="11" value="<?php echo $telp_pelanggan; ?>" required>
            </div>
            <div class="input-group">
                <input type="text" placeholder="no ktp" name="no_ktp" id="no_ktp" value="<?php echo $no_ktp; ?>" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn">Register</button>
            </div>
            <p class="login-register-text">Anda sudah punya akun? <a href="login.php">Login </a></p>
        </form>
        
    </div>
</body>
</html>