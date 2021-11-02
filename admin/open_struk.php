<?php
include_once "../library/inc.sesadmin.php";

// Periksa data Kode pada URL
if(empty($_GET['struk'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Membaca Kode dari URL
	$Kode	= $_GET['struk'];
	
	// Menghapus data Konfirmasi
	$mySql 	= "SELECT FROM konfirmasi WHERE id='$struk'";
	$myQry 	= mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=Konfirmasi-Transfer'>";
	}
}
?>