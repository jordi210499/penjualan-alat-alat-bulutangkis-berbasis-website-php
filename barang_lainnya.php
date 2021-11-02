<table width="100%" border="0" cellspacing="1" cellpadding="3">
  <tr>
    <td scope="col"><img src="images/barang_lainnya.gif" border="0" /></td>
  </tr>
  <tr>
    <th scope="col">
	<?php
	// Membaca Kode barang pada URL
	$Kode	= $_GET['Kode'];

	// menampilkan daftar barang
	$barang3Sql = "SELECT barang.*,  kategori.nm_kategori FROM barang 
				LEFT JOIN kategori ON barang.kd_kategori=kategori.kd_kategori 
				WHERE barang.kd_kategori='$KodeKategori' AND barang.kd_barang != '$Kode' 
				ORDER BY barang.kd_barang DESC LIMIT 5";
	$barang3Qry = mysql_query($barang3Sql, $koneksidb) or die ("Gagal Query".mysql_error()); 
	$nomor = 0;
	while ($barang3Data = mysql_fetch_array($barang3Qry)) {
	  $nomor++;
	  $KodeBarang = $barang3Data['kd_barang'];
	  $KodeKategori = $barang3Data['kd_kategori'];

	  // menampilkan gambar utama
	  if ($barang3Data['file_gambar']=="") {
			$fileGambar = "noimage.jpg";
	  }
	  else {
			$fileGambar	= $barang3Data['file_gambar'];
	  }
	  
	// Warna baris data
	if($nomor%2==1) { $warna=""; } else {$warna="#F5F5F5";}
	?>
        <table width="100%" border="0" cellspacing="0" cellpadding="4">
          <tr  bgcolor="<?php echo $warna; ?>">
            <td width="19%" align="center"  valign="top"><a href="?open=Barang-Lihat&amp;Kode=<?php echo $KodeBarang; ?>"> <img src="img-barang/<?php echo $fileGambar; ?>" width="100" border="0" /> </a> <br />
                <div class='harga'>Rp. <?php echo format_angka($barang3Data['harga_jual']); ?> </div>
              <br />
              <a href="?open=Barang-Beli&amp;Kode=<?php echo $KodeBarang; ?>" class="button blue large"> <strong><font color="#FFFFFF">Beli</font></strong></a> </td>
            <td width="81%" valign="top" bgcolor="<?php echo $warna; ?>"><a href="?open=Barang-Lihat&Kode=<?php echo $KodeBarang; ?>">
              <div class='judul'> <?php echo $barang3Data['nm_barang']; ?> </div>
              </a>
                <p><?php echo substr($barang3Data['keterangan'], 0, 200); ?> ....</p>
              <p><strong>Stok :</strong> <?php echo $barang3Data['stok']; ?></p>
              <p><strong>Kategori :</strong> <a href="?open=Kategori-Barang&Kode=<?php echo $KodeKategori; ?>"> <?php echo $barang3Data['nm_kategori']; ?> </a> <br />            
              </p>
              <p>&nbsp;</p></td>
          </tr>
        </table>
      <?php } ?></th>
  </tr>
  
</table>
