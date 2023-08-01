<?php
session_start();
require 'koneksi.php';

$id_paket = $_GET['id'];

$conn->query("DELETE FROM keranjang WHERE id_paket = '$id_paket'");

echo "<script>alert('paket berhasil dihapus')</script>";
      echo "<script>location='keranjang.php'</script>";


?>