<?php
session_start();
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

if(isset($_POST['btnSimpan'])){
  // Baca form
  $no_resi  =$_POST['no_resi'];
  $no_resi  =str_replace("'", "&acute;", $no_resi);
  
  // Validasi form
  $pesanError = array();
  if (trim($no_resi)=="") {
    $pesanError[] = "Data <b>Keterangan</b> tidak boleh kosong !";     
  }
  
  else {
    # SIMPAN DATA KE DATABASE. Jika tidak menemukan pesan error, simpan data ke database
    // Simpan data dari form ke database
    $mySql  = "INSERT INTO pemesanan (no_resi) 
          VALUES('$no_resi')";
    $myQry  = mysql_query($mySql, $koneksidb)  or die ("Query salah : ".mysql_error());
    if($myQry){       
      // Refresh
      echo "<meta http-equiv='refresh' content='0; url=?open=Barang-Add'>";
    }
  }   
}
?>
<html>
<head>
<title>Pemesanan Detil Barang</title>
<link href="../style/styles_cetak.css" rel="stylesheet" type="text/css">
<link href="../style/button.css" rel="stylesheet" type="text/css">
</head>
<body>
<h1>
<tr>
    <td><b>No Resi</b></td>
    <td><b>:</b></td>
    <td><strong><input name="no_resi" type="text" value="" size="12" maxlength="12" placeholder="Input Resi" required> <input type="submit" name="btnSimpan" value="Submit"/> </strong></td>
</tr>
</body>
</html>
