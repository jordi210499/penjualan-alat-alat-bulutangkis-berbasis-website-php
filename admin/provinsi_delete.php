<?php
include_once "../library/inc.sesadmin.php";

// Periksa data Kode pada URL
if(empty($_GET['Kode'])){
	echo "<b>Data yang dihapus tidak ada</b>";
}
else {
	// Hapus data sesuai Kode yang dikirim di URL
	$Kode	= $_GET['Kode'];
	$mySql 	= "DELETE FROM provinsi WHERE kd_provinsi='$Kode'";
	$myQry 	= mysql_query($mySql, $koneksidb) or die ("Eror hapus data".mysql_error());
	if($myQry){
		echo "<meta http-equiv='refresh' content='0; url=?open=Provinsi-Data'>";
	}
}
?>