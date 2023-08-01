<?php
session_start();
$conn = new mysqli("localhost", "root", "", "laundry1");

$username = $_POST['username'];
$password = md5($_POST['password']);
$ambil = $conn->query ("SELECT * FROM pelanggan WHERE username = '$username' AND password = '$password'");
$data = $ambil->num_rows;

if ($data == 1)
{
   $akun = $ambil->fetch_assoc();
   $_SESSION["pelanggan"]=$akun;
   echo "<script>alert('berhasil login')</script>";

      if(isset($_SESSION["keranjang"]) OR !empty($S_SESSION["keranjang"]))
{
      echo "<script>location='../checkout.php';</script>";
}else{
      echo "<script>location='../index.php';</script>";
}
}
else {
      
    echo "<script>alert('username dan password tidak valid')</script>";
      echo "<script>location='login.php';</script>";
}
?>