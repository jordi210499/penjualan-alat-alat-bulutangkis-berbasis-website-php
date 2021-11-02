<?php
include_once "../library/inc.connection.php";	

# BACA TOMBOL LOGIN DIKLIK
if(isset($_POST['btnLogin'])){
	// Baca variabel form
	$txtUsername = $_POST['txtUsername'];
	$txtUsername = str_replace("'","&acute;",$txtUsername);
	
	$txtPassword = $_POST['txtPassword'];
	$txtPassword = str_replace("'","&acute;",$txtPassword);
	
	// Validasi form
	$pesanError = array();
	if ( trim($txtUsername)=="") {
		$pesanError[] = "Data <b> Username </b>  tidak boleh kosong !";		
	}
	if (trim($txtPassword)=="") {
		$pesanError[] = "Data <b> Password </b> tidak boleh kosong !";		
	}

	# Jika ada error message ditemukan
	if (count($pesanError)>=1 ){
		echo "<div align='left'>";
		echo "<img src='../images/attention.png'> <br><hr>";
			$noPesan=0;
			foreach ($pesanError as $indeks=>$pesan_tampil) { 
			$noPesan++;
				echo "&nbsp;&nbsp; $noPesan. $pesan_tampil<br>";	
			} 
		echo "</div> <br>"; 
		
		// Penggil file login
		include "login.php";
	} 
	else {
		$loginSql = "SELECT * FROM admin WHERE username='".$txtUsername."' AND password ='".$txtPassword."'";
		$loginQry = mysql_query($loginSql, $koneksidb)  or die ("Query Periksa Password Salah : ".mysql_error());
		if (mysql_num_rows($loginQry) >=1) {
			// Jika berhasil login
			$_SESSION['SES_ADMIN'] = $txtUsername;
			
			echo "<meta http-equiv='refresh' content='0; url=?open=Halaman-Utama'>";	
		}
		else {
			// Jika gagal login
			echo "<b>Username atau Password</b> yang Anda masukan belum benar.
			Silahkan <a href='?open=Login'><b>Login</b></a> kembali";
			
		}
	}
}
else {
	echo "<meta http-equiv='refresh' content='0; url=?open=Login'>";
}
?>
 
