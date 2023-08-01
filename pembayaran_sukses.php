


<!DOCTYPE html>
<html>
<head>
    <title>Cetak Nota Pemesanan</title>

	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="">
    <meta name="author" content="">
	
	<link href="assets/css/bootstrap.css" rel="stylesheet">
    <link href="assets/dataTables/datatables.min.css" rel="stylesheet">
	<link rel="stylesheet" href="assets/css/font-awesome.min.css">
	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<!-- 
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
	 -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    
</head>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
</head>

<?php
session_start();
require_once("koneksi.php");

$id_pelanggan = $_SESSION["pelanggan"]["id_pelanggan"];
$id = $_GET['id'];
$main_subtotal=0;
$datas=array();
$query = "SELECT * FROM detail_transaksi LEFT JOIN transaksi ON transaksi.id_transaksi = detail_transaksi.id_transaksi WHERE transaksi.id_pelanggan = '$id_pelanggan' AND detail_transaksi.id_transaksi = '$id'";            
$result = mysqli_query($conn, $query);
    while ($data = mysqli_fetch_assoc($result))
    {
        $datas[] = $data;
    }
    foreach ($datas as $key => $item){
        $nama = $item['nama'];
        $tgl = $item['tgl'];
        $no_telp = $item['no_telp'];
        $invoice = $item['kode_invoice'];
        $total_harga = $item['total_harga'];
        $dp = $item['uang_muka'];        
        $ongkir = $item['biaya_tambahan'];        
        $status_bayar = $item['status_bayar'];
        $no=1;
    }

?>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow-lg">
                    <div class="card-header">
                        <h3 class="text-center">Pembayaran Lunas</h3>
                    </div>
                    <div class="card-body">
                        <p class="mb-0">Nama Pelanggan : <?php echo $nama ?></p>
                        <p class="mb-0">Kode Invoice : <?php echo $invoice ?></p>
                        <p class="mb-0">Nomor Telepon : <?php echo $no_telp ?></p>
                        <p class="mb-0">Tanggal Pemesanan : <?php echo $tgl ?></p>
                        <hr>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">No.</th>
                                    <th scope="col">Nama Paket</th>
                                    <th scope="col">Proses</th>
                                    <th scope="col">Harga</th>
                                    <th scope="col">Jumlah</th>
                                    <th scope="col">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php foreach ($datas as $key => $item):                            
                            $id= $item['id_transaksi'];
                            $nama_paket = $item['nama_paket'];
                            $nama_kategori = $item['nama_kategori'];
                            $harga = $item['harga'];
                            $jumlah = $item['qty'];
                            $proses = $item['proses'];
                            $subtotal = $harga * $jumlah;
                            $pelunasan = $item['pelunasan'];
                            ?>
                                <tr>
                                    <th scope="row"><?php echo $no++; ?></th>
                                    <td><?php echo $nama_paket ?></td>
                                    <td><?php echo $proses ?></td>
                                    <td>Rp. <?php echo number_format($harga) ?></td>
                                    <td><?php echo $jumlah ?></td>
                                    <td>Rp. <?php echo number_format($subtotal) ?></td>
                                </tr>
                            <?php endforeach ?>
                            </tbody>
                            <tfoot>                            
                            <tr>
                            <th colspan="3" class="text-end">Biaya Antar Jemput : Rp. <?php echo number_format($ongkir) ?></th>
                            <th colspan="4" class="text-end">Total : Rp. <?php echo number_format($total_harga) ?></th>                            
                            </tr>
                            </tfoot>
                        </table>
                    </div>
                    <div class="card-footer text-center">
                        <p>Terima kasih atas pemesanan Anda!</p>
                        <a href="cetak/cetak_pembayaran.php?id=<?php echo $id ?>" target="_blank" class="btn btn-primary btn-sm">Cetak Nota Pembayaran</a>
                        <a href="riwayat.php" class="btn btn-primary btn-sm"">Kembali Ke Menu Utama</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>


                                