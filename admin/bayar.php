
<?php
require 'koneksi.php';
if (isset($_GET['id'])) {
        $query = "UPDATE transaksi SET status_bayar = 'lunas', tgl_pembayaran = '" . date('Y-m-d') . "' WHERE id_transaksi = " . $_GET['id'];

        $insert = mysqli_query($conn, $query);
        if ($insert == 1) {
            echo "<script>alert('Pembayaran Terkonfirmasi')</script>";
            header('location: transaksi_dibayar.php?id=' . $_GET['id']);
        } else {
            echo "<div class='alert alert-danger'>Gagal Tambah Data!!!</div>";
        }
    }
?>