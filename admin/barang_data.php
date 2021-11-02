<?php
include_once "../library/inc.sesadmin.php";   // Validasi, mengakses halaman harus Login
include_once "../library/inc.connection.php"; // Membuka koneksi
include_once "../library/inc.library.php";    // Membuka librari peringah fungsi

# UNTUK PAGING (PEMBAGIAN HALAMAN)
$baris = 50;
$hal = isset($_GET['hal']) ? $_GET['hal'] : 0;
$pageSql = "SELECT * FROM barang";
$pageQry = mysql_query($pageSql, $koneksidb) or die("error paging: " . mysql_error());
$jumlah   = mysql_num_rows($pageQry);
$maksData = ceil($jumlah / $baris);
?>
<div class="container">
  <table class="table table-striped">
    <tr>
      <td height="46" colspan="2" align="right">
        <h1 align="center">DATA BARANG</h1>
      </td>
    </tr>

    <tr>
      <td colspan="2"></td>
    </tr>
    <tr>
      <td colspan="2" align="right" bgcolor="white"><a class="btn btn-outline-primary btn-sm" href="?open=Barang-Add" target="_self">Tambah Data</a></td>
    </tr>
    <tr>
      <td colspan="2">
        <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
            <th width="26" align="center" bgcolor="#CCCCCC"><strong>No</strong></th>
            <th width="88" align="center" bgcolor="#CCCCCC"><strong>Kode</strong></th>
            <th width="388" bgcolor="#CCCCCC"><strong>Nama Barang </strong></th>
            <th width="54" bgcolor="#CCCCCC"><strong> Stok</strong></th>
            <th width="116" bgcolor="#CCCCCC"><strong> Harga (Rp) </strong></th>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
          </tr>
          <?php
          $mySql = "SELECT * FROM barang ORDER BY kd_barang DESC LIMIT $hal, $baris";
          $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
          $nomor = $hal;
          while ($myData = mysql_fetch_array($myQry)) {
            $nomor++;
            $Kode = $myData['kd_barang'];
          ?>
            <tr>
              <td align="center"><?php echo $nomor; ?></td>
              <td><?php echo $myData['kd_barang']; ?></td>
              <td><?php echo $myData['nm_barang']; ?></td>
              <td align="center"><?php echo $myData['stok']; ?></td>
              <td align="right"><?php echo format_angka($myData['harga_jual']); ?></td>
              <td width="44" align="center"><a class="btn btn-primary" href="?open=Barang-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
              <td width="42" align="center"><a class="btn btn-outline-primary" href="?open=Barang-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN AKAN MENGHAPUS DATA BARANG INI ... ?')">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
    <tr class="selKecil">
      <td width="407"><b>Jumlah Data :</b> <?php echo $jumlah; ?> </td>
      <td width="384" align="right"><b>Halaman ke :</b>
        <?php
        for ($h = 1; $h <= $maksData; $h++) {
          $list[$h] = $baris * $h - $baris;
          echo " <a href='?open=Barang-Data&hal=$list[$h]'>$h</a> ";
        }
        ?></td>
    </tr>
  </table>
</div>