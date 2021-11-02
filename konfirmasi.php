<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# SAAT TOMBOL KIRIM DIKLIK
if (isset($_POST['btnKirim'])) {
	// Baca variabel form
	$txtNoPemesanan	= $_POST['txtNoPemesanan'];
	$txtNoPemesanan 		= str_replace("'", "&acute;", $txtNoPemesanan);

	$txtNama		= $_POST['txtNama'];
	$txtNama 		= str_replace("'", "&acute;", $txtNama);

	$txtJumlahTransfer		= $_POST['txtJumlahTransfer'];
	$txtJumlahTransfer 		= str_replace(".", "", $txtJumlahTransfer); // Menghilangkan karakter titik (10.000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(",", "", $txtJumlahTransfer); // Menghilangkan karakter koma (10,000 jadi 10000)
	$txtJumlahTransfer 		= str_replace(" ", "", $txtJumlahTransfer); // Menghilangkan karakter kosong (10 000 jadi 10000)

	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'", "&acute;", $txtKeterangan);

	$cmbAtm	= $_POST['cmbAtm'];
	$cmbAtm = str_replace("'", "&acute;", $cmbAtm);


	// Validasi form
	$pesanError = array();
	if (trim($txtNoPemesanan) == "") {
		$pesanError[] = "Data <b>No. Pemesanan</b>  masih kosong, isi sesuai dengan <b>No Pemesanan</b> Anda";
	}
	if (trim($txtNama) == "") {
		$pesanError[] = "Data <b>Nama Penerima</b>  masih kosong, isi sesuai nama akun Anda";
	}
	if (trim($txtJumlahTransfer) == "" or !is_numeric(trim($txtJumlahTransfer))) {
		$pesanError[] = "Data <b> Jumlah Ditransfer (Rp)</b> masih kosong, dan <b> harus ditulis angka </b>";
	}
	if (trim($txtKeterangan) == "") {
		$pesanError[] = "Data <b> Keterangan </b> masih kosong";
	}
	if (trim($cmbAtm) == "KOSONG") {
		$pesanError[] = "Data <b> ATM </b> Belum Dipilih";
	}


	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError) >= 1) {
		echo "<div class='pesanError' align='left'>";
		echo "<img src='images/attention.png'> <br><hr>";
		$noPesan = 0;
		foreach ($pesanError as $indeks => $pesan_tampil) {
			$noPesan++;
			echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";
		}
		echo "<br>";
	} else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		// Membuat tanggal
		$tanggal	= date('Y-m-d');

		// Mengkopi file gambar
		if (!empty($_FILES['namaFile']['tmp_name'])) {
			$nama_file = $_FILES['namaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'", "", $nama_file);
			$nama_file = str_replace(" ", "-", $nama_file);
			copy($_FILES['namaFile']['tmp_name'], "admin/transfer/" . $nama_file);
		} else {
			$nama_file = "";
		}

		// Simpan data ke database
		$mySql = "INSERT INTO konfirmasi (no_pemesanan, nm_pelanggan, jumlah_transfer, keterangan, tanggal, atm, struk) 
				  VALUES ('$txtNoPemesanan', '$txtNama', '$txtJumlahTransfer', '$txtKeterangan', '$tanggal', '$cmbAtm', '$nama_file')";
		$myQry	= mysql_query($mySql, $koneksidb) or die("Gagal query" . mysql_error());

		echo "<b> SUKSES ...! KONFIRMASI SUDAH DIKIRIM </b>";
		echo "<meta http-equiv='refresh' content='2; url=?open=Barang'>";
		exit;
	}
} // End if($_POST) 

# REKAM DATA JIKA KOSONG FORM
$dataNoPemesanan	= isset($_POST['txtNoPemesanan']) ? $_POST['txtNoPemesanan'] : '';
$dataNama			= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataJumlahTransfer	= isset($_POST['txtJumlahTransfer']) ? $_POST['txtJumlahTransfer'] : '';
$dataKeterangan 	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
?>
<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="form1" target="_self">
	<table width="100%" border="0" cellpadding="4" cellspacing="0">
		<tr bgcolor="#84B9D5">
			<td height="100" colspan="3" bgcolor="white" class="HEAD">
				<div align="center">
					<h3 class="font-weight-bold">KONFIRMASI PEMBAYARAN</h3>
				</div>
			</td>
		</tr>



		<tr>
			<td width="459"><b>No. Pemesanan
				</b></td>
			<td width="5"><b>:</b></td>
			<td width="726"><input name="txtNoPemesanan" type="text" value="<?php echo $dataNoPemesanan; ?>" size="20" maxlength="10" class="form-control form-control-sm" /></td>
		</tr>

		<tr>
			<td><b>Nama Pelanggan </b></td>
			<td><b>:</b></td>
			<td><input name="txtNama" type="text" value="<?php echo $dataNama; ?>" size="40" maxlength="50" class="form-control form-control-sm" /></td>
		</tr>

		<tr>
			<td><b>Jumlah Transfer (Rp.) </b></td>
			<td><b>:</b></td>
			<td><input name="txtJumlahTransfer" type="number" value="<?php echo $dataJumlahTransfer; ?>" size="20" maxlength="12" class="form-control form-control-sm" /> </td>
		</tr>

		<tr>
			<td><b>Keterangan</b></td>
			<td><b>:</b></td>
			<td><textarea class="form-control" name="txtKeterangan" cols="45" rows="4"><?php echo $dataKeterangan; ?></textarea></td>
		</tr>

		<tr>
			<td><b>ATM</b></td>
			<td><b>:</b></td>
			<td><b>
					<select name="cmbAtm" class="form-control">
						<option value="KOSONG"></option>
						<?php
						$pilihan = array("BCA", "MANDIRI");
						foreach ($pilihan as $nilai) {
							if ($nilai == $cmbAtm) {
								$cek = "selected";
							} else {
								$cek = "";
							}
							echo "<option value='$nilai' $cek>$nilai</option>";
						}
						?>
					</select>
				</b>
		</tr>
		<tr>
			<td><b>Bukti Struk</b></td>
			<td><b>:</b></td>
			<td>
				<input type="file" value="KOSONG" name="namaFile" size="70" class="form-control-file" />
			</td>
		</tr>
		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td><input type="submit" name="btnKirim" value=" Kirim "></td>
		</tr>
		<tr>
			<td colspan="3"><b>Catatan:</b><br />
				Jika bingung dengan <b>No. Pemesanan</b>, silahkan Anda Login, lalu lihatlah daftar <b>transaksi terakhir</b>.</td>
		</tr>
	</table>
</form>