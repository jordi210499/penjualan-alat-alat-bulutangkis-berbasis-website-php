<?php
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris   = 50;
$hal   = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM konfirmasi";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging: " . mysql_error());
$jumlah   = mysql_num_rows($pageQry);
$maksData = ceil($jumlah / $baris);
?>
<div class="container">
  <div class="jumbotron">

    <h1 class="text-center">KONFIRMASI TRANSFER</h1>
    <br>
    <table class="table table-striped" align="center">
      <tr>
        <th width="26" align="center" bgcolor="#CCCCCC">No</th>
        <th width="62" align="center" bgcolor="#CCCCCC">Tanggal</th>
        <th width="80" bgcolor="#CCCCCC">No. Pesan </th>
        <th width="164" bgcolor="#CCCCCC">Nama Pelanggan </th>
        <th width="119" bgcolor="#CCCCCC">Transfer (Rp)</th>
        <th width="119" bgcolor="#CCCCCC">Bukti Struk</th>
        <th width="119" bgcolor="#CCCCCC">atm</th>
        <td align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
      </tr>
      <?php
      // Menampilkan data Konfirmasi
      $mySql = "SELECT * FROM konfirmasi ORDER BY konfirmasi.id DESC LIMIT $hal, $baris";
      $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
      $nomor = 0;
      while ($myData = mysql_fetch_array($myQry)) {
        $nomor++;
        $Kode = $myData['id'];
      ?>
        <tr>
          <td><?php echo $nomor; ?></td>
          <td><?php echo IndonesiaTgl($myData['tanggal']); ?></td>
          <td><?php echo $myData['no_pemesanan']; ?></td>
          <td><?php echo $myData['nm_pelanggan']; ?></td>
          <td><?php echo format_angka($myData['jumlah_transfer']); ?></td>
          <td><a href="transfer/<?php echo $myData['struk'] ?>" class="btn btn-sm btn-primary">Lihat</a></td>
          <td><?php echo $myData['atm']; ?></td>
          <td width="39" align="center"><a href="?open=Konfirmasi-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA KONFIRMASI INI ... ?')" class="btn btn-sm btn-outline-primary">Delete</a></td>
        </tr>
      <?php } ?>
      <tr>
        <td colspan="4" bgcolor="#CCCCCC"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
        <td bgcolor="#CCCCCC"></td>
        <td colspan="3" align="right" bgcolor="#CCCCCC"><b>Halaman ke :</b>
          <?php
          for ($h = 1; $h <= $maksData; $h++) {
            $list[$h] = $baris * $h - $baris;
            echo " <a href='?open=Konfirmasi-Transfer&hal=$list[$h]'>$h</a> ";
          }
          ?></td>
      </tr>
    </table>
  </div>
</div>