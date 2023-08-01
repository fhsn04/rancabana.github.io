<?php
session_start();
require_once("inc/navbar.php");
require_once("koneksi.php");

if (!isset($_SESSION["pelanggan"]))
{
	echo "<script>alert('silahkan login terlebih dahulu')</script>";
    echo "<script>location='login/login.php'</script>";
}
$pelanggan = $_SESSION['pelanggan'];
$id_pelanggan = $_SESSION['pelanggan']['id_pelanggan'];

$sql=$conn->query("select * from pelanggan WHERE id_pelanggan='$id_pelanggan'");
$data = $sql->fetch_assoc();
?>
<br><br><br>

<div class="container">
	<div class="row">

		<div class="col-md-7">
			<div class="card p-2 shadow-lg">
                <div class="card-body bg-dark dark-gradient bg-gradient text-light">
				<h2 class="text-bs-primary text-center text-upper text-bold">Ubah <span class="text-danger">Data</span></h2>
                </div>
                <div class="card-footer">
				<form action="" method="POST" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="largeInput">Nama Akun</label>
                                <input type="text" name="nama_pelanggan" class="form-control form-control" placeholder="Nama Akun" VALUE="<?= $data['nama_pelanggan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Email</label>
                                <input type="text" name="email" class="form-control form-control" placeholder="Email" VALUE="<?= $data['email_pelanggan']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nomor KTP</label>
                                <input type="text" name="no_ktp" class="form-control form-control" placeholder="Nomor KTP" VALUE="<?= $data['no_ktp']; ?>">
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Nomor Telpon</label>
                                <input type="text" name="no_telp" class="form-control form-control" placeholder="No Telpon" VALUE="+62 <?= $data['telp_pelanggan']; ?>"></input>
                            </div>
                            <div class="input-group mt-3 mb-3">
                            <label class="input-group-text" for="inputGroupSelect01">Jenis Kelamin</label>
                                <select name="jenis_kelamin" class="form-control form-control" value="<?= $data['jenis_kelamin']; ?>">
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="largeInput">Alamat Lengkap</label>
                                <input type="text" name="alamat_pelanggan" class="form-control form-control" VALUE="<?= $data['alamat_pelanggan']; ?>"></input>
                            </div>
                            <div class="form-group">
                                    <img src="img/<?= $paket['p_foto']; ?>" width="80">
                                </div>
                            <div class="form-group">
                                <label for="largeInput">Foto Profil</label>
                                <input type="file" name="foto_p" class="form-control form-control" placeholder="foto profile"></input>
                            </div><br>
                            <div class="input-group">
                                <button type="submit" name="submit" class="btn btn-danger text-bold">Update</button>
                            </div>                            
                        </form>
                        </div>
                </div>
		    </div>    
                            
            <div class="col-md-5">
                <div class="card shadow-lg p-2">
                <div class="card-body bg-dark dark-gradient bg-gradient text-light">
                    <h2 class="text-bs-primary text-center text-upper text-bold">Data <span class="text-danger">Akun</span></h2>
                </div>
                 <div class="card-footer">
                    <div class="row">
                        <div class="col-md-7">
                        <p class="text-bold">Nama Akun : <?= $data['nama_pelanggan']; ?></p>
                        <p class="text-bold">Email : <?= $data['email_pelanggan']; ?></p>
                        <p class="text-bold">No Telp : <?= $data['telp_pelanggan']; ?></p>
                        <p class="text-bold">Jenis Kelamin : <?= $data['jenis_kelamin']; ?></p>
                        <p class="text-bold">Alamat : <?= $data['alamat_pelanggan']; ?></p>
                        </div>
                        <div class="col-md-4">
                            <img src="img/<?= $data['foto_p']; ?>" class="rounded-circle w-100 h-75"></img>
                        </div>
                    </div>
                </div>
            </div>

			</div>
        </div>
        
        
<?php
if (isset($_POST['submit'])) {
    $nama_pelanggan = $_POST['nama_pelanggan'];
    $email = $_POST['email'];
    $alamat = $_POST['alamat_pelanggan'];
    $no_ktp = $_POST['no_ktp'];
    $telp = $_POST['no_telp'];
    $jenis_kelamin = $_POST['jenis_kelamin'];
    $foto_profil = $_FILES['foto_p']['name'];
    $lokasi = $_FILES['foto_p']['tmp_name'];

    if (!empty($lokasi)){
        move_uploaded_file($lokasi, "img/$foto_profil");

    $query = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat_pelanggan = '$alamat', telp_pelanggan = '$telp',  no_ktp = '$no_ktp', jenis_kelamin = '$jenis_kelamin', email_pelanggan = '$email', foto_p = '$foto_profil' WHERE id_pelanggan = '$id_pelanggan'";

    $update = mysqli_query($conn, $query);
    }
    else
    {
    $query = "UPDATE pelanggan SET nama_pelanggan = '$nama_pelanggan', alamat_pelanggan = '$alamat', telp_pelanggan = '$telp',  no_ktp = '$no_ktp', jenis_kelamin = '$jenis_kelamin', email_pelanggan = '$email' WHERE id_pelanggan = '$id_pelanggan'";
    $update = mysqli_query($conn, $query);
    }
    echo "<script>alert('Data berhasil di ubah')</script>";
    echo "<script>location='akun.php'</script>";
}
?>
</div>

<?php require_once("inc/footer-nav.php"); ?>
<?php require_once("inc/footer.php"); ?>