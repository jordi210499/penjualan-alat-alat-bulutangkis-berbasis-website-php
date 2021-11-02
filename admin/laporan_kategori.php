<?php
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi
?>
<div class="container">
  <div class="jumbotron">
    <h2 class="text-center"> LAPORAN DATA KATEGORI</h2>
    <table class="table table-striped" align="center" width="600" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="22" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="62" bgcolor="#CCCCCC"><strong>Kode</strong></td>
        <td width="500" bgcolor="#CCCCCC"><strong>Nama Kategori</strong></td>
      </tr>
      <?php
      $mySql = "SELECT * FROM kategori ORDER BY kd_kategori ASC";
      $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
      $nomor  = 0;
      while ($myData = mysql_fetch_array($myQry)) {
        $nomor++;
      ?>
        <tr>
          <td align="center"><?php echo $nomor; ?></td>
          <td><?php echo $myData['kd_kategori']; ?></td>
          <td><?php echo $myData['nm_kategori']; ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>