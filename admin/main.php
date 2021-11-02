<?php
if (!empty($_SESSION['SES_ADMIN'])) {
	echo "<div class='container pt-5'>";
	echo "<div class='jumbotron'>";
	echo "<h1 class='text-center'> Selamat Datang Admin</h1>";
	echo "<p class='text-center py-4'>Penjelasan Pada Halaman Admin</p>";
	echo "<p class='text-center py-4'>1. Data Provinsi Berisi informasi biaya kirim untuk sampai provinsi tujuan.</p>";
	echo "<p class='text-center py-4'>2. Data Kategori Berisi informasi kategori yg berada pada toko.</p>";
	echo "<p class='text-center py-4'>3. Data Pelanggan Berisi informasi tentang pelanggan</p>";
	echo "<p class='text-center py-4'>4. Data Barang Berisi informasi barang yg dijual</p>";
	echo "<p class='text-center py-4'>5. Data Pesanan Berisi informasi barang yg dipesan oleh pelanggan</p>";
	echo "<p class='text-center py-4'>6. Laporan berisi informasi laporan transaksi dan barang</p>";
	echo "<p class='text-center py-4'>7. Ganti Password befungsi untuk mengganti password akun admin</p>";
	echo "<p class='text-center py-4'>8. Logout, Keluar halaman</p>";
	echo "</div>";
	echo "</div>";
	exit;
} else {
	echo "<br> <br> <br> <br> <br> ";
	echo "<div class='container py-5 my-5'>";
	echo "<div class='jumbotron'>";
	echo "<center>";
	echo "<h2 style='margin:-5px 0px 5px 0px; padding:0px;'>Selamat datang ........!</h2></p>";
	echo "<b> Silahkan <a href='?open=Login' alt='Login'>login </a>untuk mengakses halaman ini ";
	echo "</center>";
	echo "</div>";
}
