<?php
if(empty($_SESSION['SES_PELANGGAN'])) {
	echo "<center>";
	echo "<br> <br> <b>Maaf Akses Anda Ditolak!</b> <br>
		  Anda belum melakukan login, Untuk mengakses halaman 
      ini Anda diharuskan untuk melakukan login terlebih dahulu. Apabila belum 
      memiliki account, silahkan daftar disni <br> [ <a href='?open=Pelanggan-Baru' target='_self'>Pendaftaran Baru</a>]";
	echo "</center>";
	exit;
}
?>