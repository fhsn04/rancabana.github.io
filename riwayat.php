<?php
session_start();
require_once("inc/navbar.php");
require_once("koneksi.php");

if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu')</script>";
    echo "<script>location='login/login.php'</script>";
}

$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];
    

?>
<br>

<div class="container">
    
    <h2 class="text-center fw-bold">Riwayat Order</h2>
    
    <div class="btn-group active">
		<a href="riwayat.php?status=belum" class="btn btn-danger">Belum Dibayar</a>
        <a href="riwayat.php?status=dp" class="btn btn-danger">Sudah DP</a>
        <a href="riwayat.php?status=lunas" class="btn btn-danger">Pembayaran Lunas</a>
	</div>
                    <div class="table-responsive">
                        <table id="basic-datatables" class="display table table-striped table-hover">
                            <thead class="bg-primary">
                                <tr>
                                  <br>
                                    <th>No</th>
                                    <th>Kode</th>
                                    <th>Nama Pelanggan</th>
                                    <th>Status</th>
                                    <th>Status Pembayaran</th>
                                    <th>Uang Muka</th>
                                    <th>Total</th>
                                    <th></h4</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $no = 1;
                                $status_bayar=$_GET['status'];
                                if (empty($status_bayar)){
                                $data = mysqli_query($conn,"SELECT * from transaksi LEFT JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan WHERE transaksi.id_pelanggan ='$id_pelanggan' ORDER BY id_transaksi DESC");
                                }else{
                                    $data = mysqli_query($conn,"SELECT * from transaksi LEFT JOIN pelanggan ON transaksi.id_pelanggan = pelanggan.id_pelanggan WHERE transaksi.id_pelanggan ='$id_pelanggan' AND status_bayar = '$status_bayar' ORDER BY id_transaksi DESC");
                                }
                                    while ($trans = mysqli_fetch_assoc($data)) {
                                ?>
                                        <tr>
                                            <td><?= $no++; ?></td>
                                            <td><?= $trans['kode_invoice']; ?></td>
                                            <td><?= $trans['nama']; ?></td>
                                            <td><?= $trans['status']; ?></td>
                                            <td><?= $trans['status_bayar']; ?></td>
                                            <td><?= 'Rp ' . number_format($trans['uang_muka']); ?></td>
                                            <td><?= 'Rp ' . number_format($trans['total_harga']); ?></td>
                                            <td>
                                                <a href="sukses.php?id=<?php echo $trans['id_transaksi']; ?>" class="text-danger" type="submit"><i class="fa fa-edit">Nota Pembelian  .</i></a>
                                                <?php if ($trans['status_bayar']=="lunas"):?>
                                                <a href="pembayaran_sukses.php?id=<?php echo $trans['id_transaksi']; ?>" type="submit"><i class="fa fa-check"> Nota Pembayaran</i></a>
                                                <?php elseif ($trans['status_bayar']=="dp") : ?>
                                                <a href="bayar.php?id=<?php echo $trans['id_transaksi']; ?>" type="submit" class="btn btn-danger btn-sm">Lunasi Pembayaran</a>
                                                <?php elseif ($trans['uang_muka']!="0") : ?>
                                                <a href="bayar.php?id=<?php echo $trans['id_transaksi']; ?>" type="submit" class="btn btn-primary btn-sm">Bayar Uang Muka</a>
                                                <a href="riwayat.php?id=<?php echo $trans['id_transaksi']; ?>" class="text-danger" type="submit"><i class="fa fa-close"> batalkan pesanan</i></a>
                                                <?php else : ?>
                                                <a href="bayar.php?id=<?php echo $trans['id_transaksi']; ?>" type="submit" class="btn btn-danger btn-sm">Lunasi Pembayaran</a>
                                                <a href="riwayat.php?id=<?php echo $trans['id_transaksi']; ?>" class="text-danger" type="submit"><i class="fa fa-close"> batalkan pesanan</i></a>
                                                <?php endif ?>                                                
                                            </td>
                                        </tr>
                                <?php }
                                ?>
                                       
                            </tbody>
                        </table>
                        </div>
                        </div><br><br><br>

<?php
$query = "UPDATE transaksi SET status = 'dibatalkan' WHERE id_transaksi= " . $_GET['id'];
$update = mysqli_query($conn, $query);

if ($update) {
echo "<script>alert('pesanan dibatalkan')</script>";
echo "<script>location='riwayat.php'</script>";
} else {
    $_SESSION['msg'] = 'Gagal Hapus Data!!!';
    header('location:riwayat.php');
}

?>
                    
<div class="bottom">
<?php require_once("inc/footer-nav.php"); ?>
<?php require_once("inc/footer.php"); ?>
</div>