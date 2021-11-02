<?php
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

# Nomor Halaman (Paging)
$baris = 5;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 1;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging: " . mysql_error());
$jml	 = mysql_num_rows($pageQry);
$maks	 = ceil($jml / $baris);
$mulai	= $baris * ($hal - 1);
?>
<html>

<head>
	<link href="style/user.css" rel="stylesheet" type="text/css">
</head>

<body>


	<table width="100%" border="0" cellspacing="1" cellpadding="3">
		<tr>
			<td colspan="2" align="center" bgcolor="white" scope="col">
				<br>
				<h3 class="font-weight-bolder my-5">KOLEKSI BARANG</h3>
			</td>
		</tr>
		<?php
		// Menampilkan daftar barang
		$barangSql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
			LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
			ORDER BY barang.kd_barang DESC LIMIT $mulai, $baris";
		$barangQry = mysql_query($barangSql, $koneksidb) or die("Gagal Query" . mysql_error());
		$nomor = 0;
		while ($barangData = mysql_fetch_array($barangQry)) {
			$nomor++;
			$KodeBarang = $barangData['kd_barang'];
			$KodeKategori = $barangData['kd_kategori'];

			// Membaca file gambar
			if ($barangData['file_gambar'] == "") {
				$fileGambar = "noimage.jpg";
			} else {
				$fileGambar	= $barangData['file_gambar'];
			}

			// Warna baris data
			if ($nomor % 2 == 1) {
				$warna = "";
			} else {
				$warna = "#F5F5F5";
			}
		?>

			<tr>
				<td width="19%" align="center" valign="top">
					<br>
					<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>"><img src="img-barang/<?php echo $fileGambar; ?>" width="100" border="0"> </a> <br>
					<div class="my-4 font-weight-bolder">
						<h5 class="font-weight-bold">Rp. <?php echo format_angka($barangData['harga_jual']); ?><br></h5>
						<a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="btn btn-primary btn-block text-white my-4"> Beli</a>
					</div>
					<p>&nbsp;</p>
				</td>
				<td width="81%" valign="top" bgcolor="#F5F5F5">
					<br>
					<a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
						<div class="">
							<h4 class="font-weight-bold text-dark "><?php echo $barangData['nm_barang']; ?> </h4>
						</div>
					</a>

					<p class="px-5"><?php echo substr($barangData['keterangan'], 0, 200); ?> ....</p>
					<p><strong>Stok :</strong> <?php echo $barangData['stok']; ?></p>
					<p><strong>Kategori :</strong> <a href="?open=Kategori-Barang&Kode=<?php echo $KodeKategori; ?>"> <?php echo $barangData['nm_kategori']; ?> </a></p>
					<p>&nbsp;</p>
					<p>&nbsp;</p>
				</td>
			</tr>
		<?php } ?>



		<tr>

			<td colspan="2" align="center" bgcolor="white">
				<ul>
					<br>
					<p><b>Halaman:
							<?php
							for ($h = 1; $h <= $maks; $h++) {
								echo "[  <a href='?hal=$h'>$h</a> ]";
							}
							?>
						</b></p>
				</ul>
			</td>
		</tr>
	</table>
</body>

</html>