<script language="JavaScript" src="kalender.js"></script>
<script language=JavaScript>
document.write (hari+", "+tanggal+" "+bulan+" "+tahun)
</script>
<?php
if (isset($_SESSION['SES_PELANGGAN'])=="") {
	echo "<b>[ Status : Belum Login ";
	echo "| User : Tamu ] </b>";
}
else {
	echo "<b>[ Status : Login ";
	echo "| ID User : ".$_SESSION['SES_PELANGGAN']."  ";
	echo "| Nama : ".$_SESSION['SES_USERNAME']." ] ";
	//echo "[ <a href='login_out.php'>Logout </a> ]</b>";	
}
?>