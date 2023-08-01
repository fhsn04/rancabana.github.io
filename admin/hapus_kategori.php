<?php
require 'koneksi.php';

$query = "DELETE FROM kategori WHERE id_kategori = " . $_GET['id'];
$delete = mysqli_query($conn, $query);

if ($delete == 1) {
    $_SESSION['msg'] = 'Berhasil Mengahapus Data';
    header('location:kategori.php?');
} else {
    $_SESSION['msg'] = 'Gagal Hapus Data!!!';
    header('location:kategori.php');
}
