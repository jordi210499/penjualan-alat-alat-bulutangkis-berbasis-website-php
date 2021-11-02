<?php
session_start();
include_once "inc.session.php";
include_once "library/inc.connection.php";
include_once "library/inc.library.php";

// Baca Kode Pelanggan yang Login
$KodePelanggan	= $_SESSION['SES_PELANGGAN'];

// data Kode di URL harus ada
if(isset($_GET['Kode'])) {
	// Membaca Kode (No Pemesanan)
	$Kode	= $_GET['Kode'];
	
	// Sql membaca data Pemesanan utama sesuai Kode yang dipilih
	$mySql 	= "SELECT pemesanan.*, pelanggan.nm_pelanggan, provinsi.*
			  FROM pemesanan
			  LEFT JOIN pelanggan ON pemesanan.kd_pelanggan= pelanggan.kd_pelanggan 
			  LEFT JOIN provinsi ON pemesanan.kd_provinsi=provinsi.kd_provinsi
			  WHERE pemesanan.kd_pelanggan='$KodePelanggan' AND pemesanan.no_pemesanan ='$Kode'";
	$myQry = mysql_query($mySql, $koneksidb) or die ("Gagal query");
	$myData= mysql_fetch_array($myQry);
} 
else {
	// Jika data Kode di URL tidak terbaca
	echo "<meta http-equiv='refresh' content='0; url=?open=Transaksi-Tampil'>";
}
?>
<html>
<head>
<title>Cetak Lengkap Transaksi Pemesanan</title>
<link href="style/styles_cetak.css" rel="stylesheet" type="text/css">
</head>
<h1> CETAK LENGKAP PEMESANAN BARANG </h1>
<table width="600" border="0" cellspacing="2" cellpadding="3">
  <tr>
    <td width="30%"><strong>No. Pemesanan</strong></td>
    <td width="3%"><strong>:</strong></td>
    <td width="67%"> <?php echo $myData['no_pemesanan']; ?> </td>
  </tr>
  <tr>
    <td><strong>Tgl. Pemesanan </strong></td>
    <td><strong>:</strong></td>
    <td> <?php echo IndonesiaTgl($myData['tgl_pemesanan']); ?> </td>
  </tr>
  <tr>
    <td><strong>Kode Pelanggan</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['kd_pelanggan']; ?></td>
  </tr>
  <tr>
    <td><strong>Nama Pelanggan</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['nm_pelanggan']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Nama Penerima</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['nama_penerima']; ?></td>
  </tr>
  <tr>
    <td><strong>Alamat Penerima</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['alamat_lengkap']; ?></td>
  </tr>
  <tr>
    <td><strong>Provinsi</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['nm_provinsi']; ?> </td>
  </tr>
  <tr>
    <td><strong>Kota</strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['kota']; ?></td>
  </tr>
  <tr>
    <td><strong>No. Telepon </strong></td>
    <td><strong>:</strong></td>
    <td><?php echo $myData['no_telepon']; ?></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td><strong>Status Bayar </strong></td>
    <td><strong>:</strong></td>
    <td><strong><?php echo $myData['status_bayar']; ?></strong></td>
  </tr>
 
</table>
<table width="761" border="0" cellpadding="2" cellspacing="0">
  <tr>
    <td width="23" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
    <td width="76" bgcolor="#CCCCCC"><strong>Kode</strong></td>
    <td width="222" bgcolor="#CCCCCC"><strong>Nama Barang </strong></td>
    <td width="161" align="right" bgcolor="#CCCCCC"><strong>Harga (Rp)</strong></td>
    <td width="74" align="center" bgcolor="#CCCCCC"><strong>Jumlah</strong></td>
    <td width="181" align="right" bgcolor="#CCCCCC"><strong>Total (Rp)</strong></td>
  </tr>
  <?php 
	  // Deklarasi variabel
	  $subTotal	= 0;
	  $totalBarang = 0;
	  $totalBiayaKirim = 0;
	  $totalHarga = 0;
	  $totalBayar =0;
	  $unik_transfer =0;
	  
	  // SQL Menampilkan data Barang yang dipesan
	$tampilSql = "SELECT barang.nm_barang, pemesanan_item.*
				FROM pemesanan, pemesanan_item
				LEFT JOIN barang ON pemesanan_item.kd_barang=barang.kd_barang
				WHERE pemesanan.no_pemesanan=pemesanan_item.no_pemesanan
				AND pemesanan.no_pemesanan='$Kode'
				ORDER BY pemesanan_item.kd_barang";
	$tampilQry = mysql_query($tampilSql, $koneksidb) or die ("Gagal SQL".mysql_error());
	$no	= 0; 
	while ($tampilData = mysql_fetch_array($tampilQry)) {
	  $no++;
	  // Menghitung subtotal harga (harga  * jumlah)
	  $subTotal		= $tampilData['harga'] * $tampilData['jumlah'];
	  
	  // Menjumlah total semua harga 
	  $totalHarga 	= $totalHarga + $subTotal;  
	  
	  // Menjumlah item barang
	  $totalBarang	= $totalBarang + $tampilData['jumlah'];
  ?>
  <tr>
    <td align="center"><?php echo $no; ?></td>
    <td><?php echo $tampilData['kd_barang']; ?></td>
    <td><?php echo $tampilData['nm_barang']; ?></td>
    <td align="right">Rp. <?php echo format_angka($tampilData['harga']); ?></td>
    <td align="right"><?php echo $tampilData['jumlah']; ?></td>
    <td align="right">Rp. <?php echo format_angka($subTotal); ?></td>
  </tr>
  <?php } 
  	// Menghitung
		// Total biaya Kirim = Biaya kirim x Total barang
		$totalBiayaKirim = $myData['biaya_kirim'] * $totalBarang;
		
		$totalBayar = $totalHarga + $totalBiayaKirim;  
		
		$digitHp 	= substr($myData['no_telepon'],-3); // ambil 3 digit terakhir no HP
		$unik_transfer = substr($totalBayar,0,-3).$digitHp;
  ?>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td align="right">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Total Belanja (Rp) : </strong></td>
    <td align="right">Rp. <?php echo format_angka($totalHarga); ?></td>
  </tr>
  <tr>
    <td colspan="5" align="right"><strong>Total Biaya Kirim  (Rp) : </strong></td>
    <td align="right">Rp. <?php echo format_angka($totalBiayaKirim); ?></td>
  </tr>
  <tr>
    <td height="20" colspan="5" align="right"><strong>GRAND TOTAL  (Rp) : </strong></td>
    <td align="right">Rp. <?php echo format_angka($totalBayar); ?></td>
  </tr>
  <tr>
    <td colspan="6" align="right" bgcolor="#F5F5F5">Nominal pembayarannya adalah <b>Rp. <?php echo format_angka($totalBayar); ?></b> </td>
  </tr>
</table>
<p><strong>Rekening Pembayaran:<br> 
  BCA 0312849389 a.n. Agy Vahrezi<br>
    
  Mandiri 13700045678910 a.n. Agy Vahrezi<br>
  Apabila sudah transfer, silahkan melakukan konfirmasi pada menu konfirmasi
</strong></p>
<p>&nbsp;</p>
<p><b>* Keterangan Status Pembayaran :</b></p>
<ul>
  <li><b>Pesan :</b> Masih dalam pemesanan atau <strong>Belum Dibayar</strong>.</li>
  <li><b>Lunas :</b> Pemesanan sudah dibayar Lunas, dan <strong>Dalam Proses Pengiriman</strong>.</li>
</ul>
</body>
</html>
