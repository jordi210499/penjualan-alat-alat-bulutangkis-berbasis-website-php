<?php
// Membaca Kode dari URL
if(isset($_GET['Kode'])){
	$Kode	= $_GET['Kode'];
	
	// Menampilkan data sesuai Kode dari URL
	$lihatSql = "SELECT barang.*, kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori
				WHERE barang.kd_barang='$Kode'";
	
	$lihatQry = mysql_query($lihatSql, $koneksidb) or die ("Data Gagal Ditampilkan ..!");
	$no=0;
	$lihatData = mysql_fetch_array($lihatQry);
	  $no++;
	  $KodeBarang= $lihatData['kd_barang'];
	  $KodeKategori = $lihatData['kd_kategori'];
	  	  
	  // Membaca gambar utama
	  if ($lihatData['file_gambar']=="") {
			$fileGambar = "noimage.jpg";
	  }
	  else {
			$fileGambar	= $lihatData['file_gambar'];
	  }
} 
else {
	// Jika variabel Kode tidak ada di URL
	echo "Kode barang tidak ada ";
	
	// Refresh
	echo "<meta http-equiv='refresh' content='2; url=index.php'>";
	exit;
}
?>
<table width="99%" border="0" cellspacing="0" cellpadding="0">
  <tr> 
    <td width="21%" align="center" valign="top">
	<img src="img-barang/<?php echo $fileGambar; ?>" width="200" border="0" /><br />
    <div class='harga'>Rp. <?php echo format_angka($lihatData['harga_jual']); ?> </div> <br />
    <a href="?open=Barang-Beli&Kode=<?php echo $KodeBarang; ?>" class="button blue large"> <strong><font color="#FFFFFF">Beli</font></strong></a> </td>
    <td width="79%" align="center" valign="top">
	<table width="99%" border="0" cellspacing="2" cellpadding="3">
        <tr> 
          <td colspan="3"><img src="images/detail_barang.gif" ></td>
        </tr>
        <tr> 
          <td width="24%"><b>Nama  </b></td>
          <td width="1%">:</td>
          <td width="75%"><b><?php echo $lihatData['nm_barang']; ?></b> </td>
        </tr>
        <tr> 
          <td><b>Harga (Rp.)</b></td>
          <td>:</td>
          <td><?php echo format_angka($lihatData['harga_jual']); ?></td>
        </tr>
        <tr> 
          <td><b>Stok</b></td>
          <td>:</td>
          <td><?php echo $lihatData['stok']; ?></td>
        </tr>
        <tr> 
          <td><b>Kategori </b></td>
          <td>:</td>
          <td><?php echo $lihatData['nm_kategori']; ?></td>
        </tr>
        <tr> 
          <td>&nbsp;</td>
          <td>&nbsp;</td>
          <td>&nbsp;</td>
        </tr>
        <tr> 
          <td colspan="3" valign="top"><?php echo $lihatData['keterangan']; ?></td>
        </tr>
      </table></td>
  </tr>
</table>
<p>&nbsp;</p>
<?php
// Menampilkan barang lainnya (sejenis dengan barang yang sedang dilihat/ diview)
include "barang_lainnya.php";
?>
