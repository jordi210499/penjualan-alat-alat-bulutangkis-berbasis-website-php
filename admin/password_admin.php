<?php
// Validasi Login : yang boleh mengakses halaman ini hanya yang sudah Login admin
include_once "../library/inc.sesadmin.php";

# Tombol Simpan diklik
if (isset($_POST['btnSimpan'])) {
	// Baca form
	$txtPassBaru = $_POST['txtPassBaru'];
	$txtPassLama = $_POST['txtPassLama'];

	// Validasi form
	$pesanError = array();
	if (trim($txtPassBaru) == "") {
		$pesanError[] = "Data <b> Password baru </b> belum diisi !";
	}

	// Validasi Password lama (harus benar)
	$sqlCek = "SELECT * FROM admin WHERE username='admin' AND password ='" . $txtPassLama . "'";
	$qryCek = mysql_query($sqlCek, $koneksidb)  or die("Query Periksa Password Salah : " . mysql_error());
	if (mysql_num_rows($qryCek) < 1) {
		$pesanError[] = "Maaf, <b> Password Anda Salah</b>....silahkan ulangi";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError) >= 1) {
		echo "<div class='mssgBox'>";
		echo "<img src='../images/attention.png'> <br><hr>";
		$noPesan = 0;
		foreach ($pesanError as $indeks => $pesan_tampil) {
			$noPesan++;
			echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
		}
		echo "</div> <br>";
	} else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$mySql	= "UPDATE admin SET password='" . $txtPassBaru . "'";
		$myQry	= mysql_query($mySql, $koneksidb);
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=?page=Logout&Info=Password Berhasil Diganti'>";
		}
	}
}

# Membaca Data Login untuk diedit
$mySql = "SELECT * FROM admin";
$myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
$myData = mysql_fetch_array($myQry);
?>
<div class="container">
	<div class="jumbotron">

		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="form1">
			<table class="table table-striped" width="100%">
				<tr>
					<th colspan="3">GANTI PASSWORD ADMIN </th>
				</tr>
				<tr>
					<td><strong>Password Lama </strong></td>
					<td><b>:</b></td>
					<td><input name="txtPassLama" type="password" value="" size="40" maxlength="30" class="form-control" /></td>
				</tr>
				<tr>
					<td><strong>Password Baru </strong></td>
					<td><b>:</b></td>
					<td><input name="txtPassBaru" type="password" value="" size="40" maxlength="30" class="form-control" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer;" class="btn btn-outline-primary btn-block"></td>
				</tr>
			</table>
		</form>

	</div>
</div>