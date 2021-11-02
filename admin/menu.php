<?php
# JIKA DIKENALI YANG LOGIN ADMIN
if (isset($_SESSION['SES_ADMIN'])) {
?>
  <!--navbar-->
  <nav class="navbar navbar-expand-lg navbar-light bg-dark">

    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item active pr-4">
          <a class="nav-link text-white" href='?open' title='Halaman Utama'>Beranda <span class="sr-only">(current)</span></a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Provinsi-Data' title='Provinsi' target="_self">Data Provinsi</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Kategori-Data' title='Kategori' target="_self">Data Kategori</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Pelanggan-Data' title='Pelanggan' target="_self">Data Pelanggan</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Barang-Data' title='Barang' target="_self">Data Barang</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Pemesanan-Barang' title='Pemesanan Barang' target="_self">Pesanan Barang</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Konfirmasi-Transfer' title='Konfirmasi Transfer' target="_self">Konfirmasi Transfer</a>
        </li>

        <li class=" nav-item pr-4">
          <a class="nav-link text-white" href='?open=Laporan' title='Laporan' target="_self">Laporan</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Password-Admin' title='Password Admin'>Ganti Password</a>
        </li>

        <li class="nav-item pr-4">
          <a class="nav-link text-white" href='?open=Logout' title='Logout (Exit)'>Logout</a>
        </li>

      </ul>
    </div>
  </nav>
  <!--tutup navbar-->


<?php } ?>