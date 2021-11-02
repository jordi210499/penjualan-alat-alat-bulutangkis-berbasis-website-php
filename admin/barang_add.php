<?php
// Validasi Login : yang boleh mengakses halaman ini hanya yang sudah Login admin
include_once "../library/inc.sesadmin.php";

# TOMBOL SIMPAN DIKLIK
if (isset($_POST['btnSimpan'])) {
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'", "&acute;", $txtNama);
	$txtNama	= ucwords(strtolower($txtNama));

	$txtHrgModal	= $_POST['txtHrgModal'];
	$txtHrgModal 	= str_replace("'", "&acute;", $txtHrgModal);

	$txtHrgJual		= $_POST['txtHrgJual'];
	$txtHrgJual 	= str_replace("'", "&acute;", $txtHrgJual);

	$txtStok	= $_POST['txtStok'];
	$txtStok 	= str_replace("'", "&acute;", $txtStok);

	$txtKeterangan	= $_POST['txtKeterangan'];
	$txtKeterangan 	= str_replace("'", "&acute;", $txtKeterangan);

	$cmbKategori	= $_POST['cmbKategori'];

	// Validasi form
	$pesanError = array();
	if (trim($txtNama) == "") {
		$pesanError[] = "Data <b>Nama Barang</b> tidak boleh kosong !";
	}
	if (trim($txtHrgModal) == ""  or !is_numeric(trim($txtHrgModal))) {
		#$pesanError[] = "Data <b>Harga Modal (Rp)</b> tidak boleh kosong !";		
	}
	if (trim($txtHrgJual) == ""  or !is_numeric(trim($txtHrgJual))) {
		$pesanError[] = "Data <b>Harga Jual (Rp)</b> tidak boleh kosong !";
	}
	if (trim($txtStok) == "" or !is_numeric(trim($txtStok))) {
		$pesanError[] = "Data <b>Stok</b>  tidak boleh kosong !";
	}
	if (trim($txtKeterangan) == "") {
		$pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";
	}
	if (trim($cmbKategori) == "KOSONG") {
		$pesanError[] = "Data <b>Kategori</b> belum dipilih !";
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
		// Membuat kode baru
		$kodeBaru	= buatKode("barang", "BG");

		// Mengkopi file gambar
		if (!empty($_FILES['namaFile']['tmp_name'])) {
			$nama_file = $_FILES['namaFile']['name'];
			$nama_file = stripslashes($nama_file);
			$nama_file = str_replace("'", "", $nama_file);
			$nama_file = str_replace(" ", "-", $nama_file);
			$nama_file = $kodeBaru . "." . $nama_file;
			copy($_FILES['namaFile']['tmp_name'], "../img-barang/" . $nama_file);
		} else {
			$nama_file = "";
		}

		// Simpan data dari form ke database
		$mySql	= "INSERT INTO barang (kd_barang, nm_barang, harga_modal, harga_jual, stok, keterangan, file_gambar,  kd_kategori) 
					VALUES('$kodeBaru', '$txtNama', '$txtHrgModal', '$txtHrgJual',  '$txtStok', '$txtKeterangan', '$nama_file', '$cmbKategori')";
		$myQry	= mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
		if ($myQry) {
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
		}
	}
}

# MEMBUAT NILAI DATA PADA FORM
# SIMPAN DATA PADA FORM, Jika saat Sumbit ada yang kosong (lupa belum diisi)
$dataKode		= buatKode("barang", "BG");
$dataNama		= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataHrgModal	= isset($_POST['txtHrgModal']) ? $_POST['txtHrgModal'] : '';
$dataHrgJual	= isset($_POST['txtHrgJual']) ? $_POST['txtHrgJual'] : '';
$dataStok		= isset($_POST['txtStok']) ? $_POST['txtStok'] : '';
$dataKeterangan	= isset($_POST['txtKeterangan']) ? $_POST['txtKeterangan'] : '';
$dataKategori	= isset($_POST['cmbKategori']) ? $_POST['cmbKategori'] : '';
?>

<div class="container">
	<div class="jumbotron">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" enctype="multipart/form-data" name="frmadd">
			<table class="table-list" width="100%" style="margin-top:0px;">
				<tr>
					<th colspan="3" class="text-center">
						<h1>TAMBAH DATA BARANG</h1>
						<br>
					</th>
				</tr>
				<tr>
					<td width="14%"><strong>Kode</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td width="85%"><input name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="5" readonly="readonly" class="form-control mb-2 mr-sm-2" /></td>
				</tr>
				<tr>
					<td><strong>Nama Barang </strong></td>
					<td><strong>:</strong></td>
					<td><input name="txtNama" value="<?php echo $dataNama; ?>" size="50" maxlength="50" class="form-control mb-2 mr-sm-2" /></td>
				</tr>
				<tr>
					<td><strong>Harga Modal (Rp) </strong></td>
					<td><strong>:</strong></td>
					<td><input name="txtHrgModal" type="number" value="<?php echo $dataHrgModal; ?>" size="20" maxlength="12" class="form-control mb-2 mr-sm-2" /></td>
				</tr>
				<tr>
					<td><strong>Harga Jual (Rp) </strong></td>
					<td><strong>:</strong></td>
					<td><input name="txtHrgJual" type="number" value="<?php echo $dataHrgJual; ?>" size="20" maxlength="12" class="form-control mb-2 mr-sm-2" /></td>
				</tr>
				<tr>
					<td><strong>Jumlah Stok </strong></td>
					<td><strong>:</strong></td>
					<td><input name="txtStok" type="number" value="<?php echo $dataStok; ?>" size="10" maxlength="4" class="form-control mb-2 mr-sm-2" /></td>
				</tr>
				<tr>
					<td><strong>File Gambar </strong></td>
					<td><strong>:</strong></td>
					<td><input name="namaFile" type="file" size="70" /></td>
				</tr>
				<tr>
					<td><strong>Keterangan</strong></td>
					<td><strong>:</strong></td>
					<td><textarea id="elm1" name="txtKeterangan" cols="70" rows="6"><?php echo $dataKeterangan; ?></textarea></td>
				</tr>
				<tr>
					<td><strong>Kategori</strong></td>
					<td><strong>:</strong></td>
					<td><select name="cmbKategori" class="form-control mb-2 mr-sm-2">
							<option value="KOSONG">....</option>
							<?php
							$mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
							$myQry = mysql_query($mySql, $koneksidb) or die("Gagal Query" . mysql_error());
							while ($myData = mysql_fetch_array($myQry)) {
								if ($myData['kd_kategori'] == $dataKategori) {
									$cek = " selected";
								} else {
									$cek = "";
								}
								echo "<option value='$myData[kd_kategori]' $cek> $myData[nm_kategori] </option>";
							}
							?>
						</select></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input class="btn btn-primary" type="submit" name="btnSimpan" value=" SIMPAN DATA " style="cursor:pointeronclick=" return confirm("ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?");></td>
				</tr>
			</table>
		</form>
	</div>
</div>