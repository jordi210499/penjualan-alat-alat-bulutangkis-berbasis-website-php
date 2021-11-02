<?php
// Validasi : Halaman ini hanya untuk yang sudah login
include_once "../library/inc.sesadmin.php";

# MEMBACA TOMBOL SIMPAN DIKLIK
if (isset($_POST['btnSimpan'])) {
	// Baca form
	$txtNama	= $_POST['txtNama'];
	$txtNama 	= str_replace("'", "&acute;", $txtNama); // Membuang karakter petik (')

	// Validasi form
	$pesanError = array();
	if (trim($txtNama) == "") {
		$pesanError[] = "Data <b>Nama Kategori</b> tidak boleh kosong !";
	}

	// Validasi Nama Kategori, tidak boleh ada yang kembar (namanya sama)
	$cekSql	= "SELECT * FROM kategori WHERE nm_kategori='$txtNama'";
	$cekQry	= mysql_query($cekSql, $koneksidb) or die("Eror Query" . mysql_error());
	if (mysql_num_rows($cekQry) >= 1) {
		$pesanError[] = "Maaf, Kategori <b> $txtNama </b> sudah ada, ganti dengan yang nama berbeda";
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
		$kodeBaru = buatKode("kategori", "K");
		$mySql	= "INSERT INTO kategori SET kd_kategori='$kodeBaru', nm_kategori='$txtNama'";
		$myQry	= mysql_query($mySql) or die("Query salah : " . mysql_error());
		if ($myQry) {
			echo "<meta http-equiv='refresh' content='0; url=?open=Kategori-Add'>";
		}
	}
} // End if($_POST) 


# Membuat nilai data pada form input
$dataKode		= buatKode("kategori", "K");
$dataKategori	= isset($_POST['txtNama']) ?  $_POST['txtNama'] : '';
?>

<div class="container">
	<div class="jumbotron">
		<form action="<?php $_SERVER['PHP_SELF']; ?>" method="post" name="frmadd" target="_self">
			<table class="table-list" width="100%" style="margin-top:0px;">
				<tr>
					<h1 class="text-center">TAMBAH DATA PROVINSI</h1>
					<br>
				</tr>
				<tr>
					<td width="18%"><strong>Kode</strong></td>
					<td width="1%"><strong>:</strong></td>
					<td width="81%"><input class="form-control mb-2 mr-sm-2" name="textfield" value="<?php echo $dataKode; ?>" size="10" maxlength="10" readonly="readonly" /></td>
				</tr>
				<tr>
					<td><strong>Nama Kategori</strong></td>
					<td><strong>:</strong></td>
					<td><input name="txtNama" class="form-control mb-2 mr-sm-2" value="<?php echo $dataKategori; ?>" size="50" maxlength="50" /></td>
				</tr>
				<tr>
					<td>&nbsp;</td>
					<td>&nbsp;</td>
					<td><input class="btn btn-primary" type="submit" name="btnSimpan" value=" SIMPAN " style="cursor:pointer" ; onclick="myFunction()">
						<script>
							function myFunction() {
								alert("KATEGORI BERHASIIL DISIMPAN");
							}
						</script>
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>