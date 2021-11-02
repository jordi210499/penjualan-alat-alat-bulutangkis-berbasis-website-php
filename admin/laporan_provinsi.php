<?php
include_once "../library/inc.sesadmin.php";   // Validasi halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi
?>

<div class="container">
  <div class="jumbotron">
    <h2 class="text-center"> LAPORAN DATA PROVINSI</h2>
    <br>
    <table class="table table-striped" align="center" width="600" border="0" cellspacing="1" cellpadding="2">
      <tr>
        <td width="29" align="center" bgcolor="#CCCCCC"><strong>No</strong></td>
        <td width="413" bgcolor="#CCCCCC"><strong>Nama Provinsi </strong></td>
        <td width="142" align="right" bgcolor="#CCCCCC"><strong>Biaya Kirim (Rp) </strong></td>
      </tr>
      <?php
      $mySql = "SELECT * FROM provinsi ORDER BY nm_provinsi ASC";
      $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
      $nomor = 0;
      while ($myData = mysql_fetch_array($myQry)) {
        $nomor++;
      ?>
        <tr>
          <td align="center"><?php echo $nomor; ?></td>
          <td><?php echo $myData['nm_provinsi']; ?></td>
          <td align="right"><?php echo format_angka($myData['biaya_kirim']); ?></td>
        </tr>
      <?php } ?>
    </table>
  </div>
</div>