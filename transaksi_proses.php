<?php
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
 
// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];

# MEMERIKSA DATA DALAM KERANJANG
$cekSql = "SELECT * FROM tmp_keranjang WHERE  kd_pelanggan='$KodePelanggan'";
$cekQry = mysql_query($cekSql, $koneksidb) or die (mysql_error());
$cekQty = mysql_num_rows($cekQry);
if($cekQty < 1){
	echo "<br><br>";
	echo "<center>";
	echo "<b> BELUM ADA TRANSAKSI </b>";
	echo "<center>";
	
	// Jika Keranjang masih Kosong, maka halaman Refresh ke data Barang
	echo "<meta http-equiv='refresh' content='2; url=?page=Barang'>";
	exit;
}

# SAAT TOMBOL SIMPAN DIKLIK, Masuk ke proses simpan data
if(isset($_POST['btnSimpan'])){
	# Baca Variabel Form
	$txtNama	= $_POST['txtNama'];
	$txtNama	= str_replace("'","&acute;",$txtNama);
		
	$txtAlamat	= $_POST['txtAlamat'];
	$txtAlamat	= str_replace("'","&acute;",$txtAlamat);
	
	$cmbProvinsi= $_POST['cmbProvinsi'];

	$txtKota	= $_POST['txtKota'];
	$txtKota	= str_replace("'","&acute;",$txtKota);

	$txtPos		= $_POST['txtPos'];
	$txtPos		= str_replace("'","&acute;",$txtPos);
	
	$txtNoTelp	= $_POST['txtNoTelp'];
	$txtNoTelp	= str_replace("'","&acute;",$txtNoTelp);
	
	// Validasi, jika data kosong kirimkan pemesanan error
	$pesanError = array();
	if (trim($txtNama) =="") {
		$pesanError[] = "Data <b>Nama Penerima</b> masih kosong";
	}
	if (trim($txtAlamat) =="") {
		$pesanError[] = "Data <b>Alamat Tujuan Pengiriman</b> masih kosong";
	}
	if (trim($cmbProvinsi) =="KOSONG") {
		$pesanError[] =  "Data <b>Provinsi Pengiriman</b> belum dipilih";
	}
	if (trim($txtKota) =="") {
		$pesanError[] = "Data <b>Kota Tujuan</b> masih kosong";
	}
	if (trim($txtPos) =="") {
		$pesanError[] = "Data <b>Kode Pos</b> masih kosong";
	}
	if (trim($txtNoTelp) =="") {
		$pesanError[] = "Data <b>No. Telepon</b> masih kosong";
	}

	# JIKA ADA PESAN ERROR DARI VALIDASI
	if (count($pesanError)>=1 ){
		echo "<div class='pesanError' align='left'>";
		echo "<img src='images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo " <br>"; 
	}
	else {
		# SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
		$KodePemesanan	= buatKode("pemesanan", "PS");
		$tanggal		= date('Y-m-d');
		
		# SIMPAN DATA IDENTITAS PENGIRIMAN KE DATABASE
		$mySql	= "INSERT INTO pemesanan (no_pemesanan, tgl_pemesanan, kd_pelanggan, nama_penerima, 
					alamat_lengkap, kd_provinsi, kota, kode_pos, no_telepon)
					VALUES('$KodePemesanan', '$tanggal', '$KodePelanggan', '$txtNama', 
					'$txtAlamat', '$cmbProvinsi', '$txtKota', '$txtPos', '$txtNoTelp')";
		$myQry	= mysql_query($mySql, $koneksidb) or die ("Gagal query 1".mysql_error());
		if($myQry){
			// Membaca data dari TMP (Kantong belanja)
			$bacaSql	= "SELECT * FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
			$bacaQry	= mysql_query($bacaSql, $koneksidb) or die ("Gagal query 2".mysql_error());
			while ($bacaData = mysql_fetch_array($bacaQry)) {
				// Simpan data dari Keranjang belanja ke Pemesanan_Item
				$Kode 	= $bacaData['kd_barang'];
				$Harga	= $bacaData['harga'];
				$Jumlah	= $bacaData['jumlah'];
				
				$simpanSql="INSERT INTO pemesanan_item(no_pemesanan, kd_barang, harga, jumlah) 
							VALUES('$KodePemesanan', '$Kode', '$Harga', '$Jumlah')";
				mysql_query($simpanSql,$koneksidb) or die ("Gagal query simpan".mysql_error());
			}
			
			// Kosongkan data Keranjang milik Pelanggan 
			$hapusSql	= "DELETE FROM tmp_keranjang WHERE kd_pelanggan='$KodePelanggan'";
			mysql_query($hapusSql,$koneksidb) or die ("Gagal query hapus keranjang".mysql_error());
			
			// Refresh
			echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Sukses&Act=Sukses'>";
		}
		exit;
	}	
} // End if($_POST) 

# MEMBACA DATA DARI FORM, untuk ditampilkan kembali pada form
$dataNama	= isset($_POST['txtNama']) ? $_POST['txtNama'] : '';
$dataAlamat	= isset($_POST['txtAlamat']) ? $_POST['txtAlamat'] : '';
$dataProvinsi	= isset($_POST['cmbProvinsi']) ? $_POST['cmbProvinsi'] : '';
$dataKota	= isset($_POST['txtKota']) ? $_POST['txtKota'] : '';
$dataPos	= isset($_POST['txtPos']) ? $_POST['txtPos'] : '';
$dataNoTelp =  isset($_POST['txtNoTelp']) ? $_POST['txtNoTelp'] : '';
?>
<table width="100%" border="0" align="center" cellpadding="2" cellspacing="0" class="table-list">
  <tr>
    <td height="22" colspan="5" bgcolor="#CCCCCC"><strong>KONFIRMASI BELANJA </strong></td>
  </tr>
  <tr>
    <td width="25" align="center" bgcolor="#F5F5F5"><strong>No</strong></td>
    <td width="913" height="22" bgcolor="#F5F5F5"><strong>Nama Barang </strong></td>
    <td width="129" align="right" bgcolor="#F5F5F5"><strong>Harga (Rp)</strong></td>
    <td width="66" align="center" bgcolor="#F5F5F5"><strong>Jumlah</strong></td>
    <td width="128" align="right" bgcolor="#F5F5F5"><strong>Total (Rp)</strong></td>
  </tr>
  <?php
  	// buat variabel data
	$subTotal	= 0;
	$totalHarga	= 0;
	$totalBarang = 0;
	
  // Menampilkan daftar barang yang sudah dipilih (ada d Keranjang)
	$mySql = "SELECT barang.nm_barang, tmp_keranjang.*
			FROM tmp_keranjang
			LEFT JOIN barang ON tmp_keranjang.kd_barang=barang.kd_barang
			WHERE barang.kd_barang=tmp_keranjang.kd_barang AND tmp_keranjang.kd_pelanggan='$KodePelanggan' 
			ORDER BY tmp_keranjang.id";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal SQL".mysql_error());
	$nomor	= 0;
	while ($myData = mysql_fetch_array($myQry)) {
	  $nomor++;
	  // Mendapatkan total harga (harga * jumlah)
	  $subTotal= $myData['harga'] * $myData['jumlah']; 
	  
	  // Mendapatkan total harga  dari seluruh  barang
	  $totalHarga = $totalHarga + $subTotal; 
	  
	  // Mendapatkan total barang
	  $totalBarang = $totalBarang + $myData['jumlah']; 
  ?>
  <tr>
    <td align="center"><?php echo $nomor; ?></td>
    <td><a href="?open=Barang-Lihat&amp;Kode=<?php echo $myData['kd_barang']; ?>" target="_blank"><?php echo $myData['nm_barang']; ?></a></td>
    <td align="right">Rp.<?php echo format_angka($myData['harga']); ?></td>
    <td align="center"><?php echo $myData['jumlah']; ?></td>
    <td align="right">Rp. <?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php } ?>
  <tr>
    <td colspan="3" align="right"><b>GRAND TOTAL BELANJA :</b></td>
    <td align="center" bgcolor="#F5F5F5"><?php echo $totalBarang; ?></td>
    <td align="right" bgcolor="#F5F5F5"><strong>Rp. <?php echo format_angka($totalHarga); ?></strong></td>
  </tr>
</table>
<form name="form1" method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
  <table width="100%" border="0" align="center" cellpadding="3" cellspacing="0">
    <tr align="center">
      <td height="22" colspan="3">&nbsp;</td>
    </tr>
    <tr> 
      <td height="22" colspan="3" bgcolor="#CCCCCC"><b> ALAMAT TUJUAN PENGIRIMAN BARANG </b></td>
    </tr>
    <tr> 
      <td width="426"><b>&nbsp;&nbsp;Nama Penerima</b></td>
      <td width="5"><strong>:</strong></td>
      <td width="753"><input name="txtNama" type="text" size="50" maxlength="50" value="<?php echo $dataNama; ?>"></td>
    </tr>
    <tr>
      <td><b>&nbsp;&nbsp;Alamat  Tujuan </b></td>
      <td><strong>:</strong></td>
      <td><textarea name="txtAlamat" cols="50" rows="2"><?php echo $dataAlamat; ?></textarea></td>
    </tr>
    <tr> 
      <td><b>&nbsp;&nbsp;Provinsi Tujuan </b></td>
      <td><strong>:</strong></td>
      <td> <select name="cmbProvinsi">
          <option value="KOSONG" selected>....</option>
          <?php
		$comboSql = "SELECT * FROM provinsi ORDER BY nm_provinsi ASC";
		$comboQry = mysql_query($comboSql, $koneksidb) or die ("Gagal query".mysql_error());
		while ($comboData =mysql_fetch_array($comboQry)) {
			if ($comboData['kd_provinsi']==$dataProvinsi) {
				$cek="selected";
			}
			else {
				$cek="";
			}
			echo "<option value='$comboData[kd_provinsi]' $cek>$comboData[nm_provinsi]</option>";
		}
		?>
        </select> </td>
    </tr>
    <tr> 
      <td><b>&nbsp;&nbsp;Kota Tujuan </b></td>
      <td><strong>:</strong></td>
      <td> <input name="txtKota" type="text" size="50" maxlength="50" value="<?php echo $dataKota; ?>"></td>
    </tr>
    <tr> 
      <td><b>&nbsp;&nbsp;Kode Pos</b></td>
      <td><strong>:</strong></td>
      <td> <input name="txtPos" type="text" size="6" maxlength="5" value="<?php echo $dataPos; ?>"> 
        <font color="#FF0000" size="1">* (diisi minimal/max 5 digit)</font></td>
    </tr>
    <tr> 
      <td><b>&nbsp;&nbsp;No. Telepon</b></td>
      <td><strong>:</strong></td>
      <td> <input name="txtNoTelp" type="number" size="20" maxlength="20" value="<?php echo $dataNoTelp; ?>"></td>
    </tr>
    <tr> 
      <td>&nbsp;</td>
      <td>&nbsp;</td>
      <td><input name="btnSimpan" type="submit" value=" Simpan &amp; Lanjutkan Transaksi " /></td>
    </tr>
  </table>
</form>
