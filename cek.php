if($proses == 'kiloan' && !$alert_shown){
                $subharga_kl = $dp;
                $main_subtotal = $main_subtotal + $subharga_kl;
                echo " <p  class='alert alert-danger'>perhatian !! anda memilih jenis layanan kiloan maka total harganya digantikan dengan uang muka yaitu sebesar Rp. 5,000.</p> ";
                $alert_shown = true;
            }else{
                $main_subtotal = $main_subtotal + $subharga;          
             }



foreach ($mergedItems as $id => $item) {
    
    $nama_paket = $item['nama_paket'];
    $harga = $item['harga'];
    $jumlah = $item['qty'];
    $proses = $item['proses'];
    $nama_kategori = $item['nama_kategori'];
    $ongkir = 5000;

    setlocale(LC_ALL, 'id_id');


    <div class="btn-group">
		<a href="riwayat.php?status=belum" class="btn btn-danger">Belum Dibayar</a>
        <a href="riwayat.php?status=dp" class="btn btn-danger">Sudah DP</a>
        <a href="riwayat.php?status=lunas" class="btn btn-danger">Pembayaran Lunas</a>
	</div>

    $proses = $data['proses'];
    $subtotal= $data['harga'] * $data['qty'];                
    $ongkir= $data['biaya_tambahan'];
    $main_subtotal= $main_subtotal + $subtotal; 


    <?php
            $id=$_GET($trans['id_transaksi']);        
             if (isset($_POST['hapus'])){
                $conn->query("UPDATE FROM transaksi SET resi_p = NULL WHERE id_transaksi ='$id'");
            }