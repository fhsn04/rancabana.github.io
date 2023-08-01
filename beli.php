<?php
session_start();
require_once("inc/navbar.php");
require_once("koneksi.php");

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
$id = $_GET['id'];

echo "<script>alert('Berhasil Ditambahkan Ke Keranjang')</script>";
      echo "<script>location='keranjang.php'</script>";
foreach ($_SESSION["keranjang"] as $id_paket){
$conn->query("INSERT INTO keranjang (id_pelanggan, id_paket, aktif) VALUES ('$id_pelanggan', '$id', 'y')");
}

?>
