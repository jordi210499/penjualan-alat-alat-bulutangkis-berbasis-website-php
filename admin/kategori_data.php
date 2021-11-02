<?php
// Validasi supaya yang mengakses hanya Admin (yang sudah login)
include_once "../library/inc.sesadmin.php";
?>

<div class="container py-5">
  <table class="table table-striped">
    <tr>
      <td colspan="2">
        <h1 class="text-center">DATA KATEGORI</h1>
      </td>
    </tr>
    <tr>

      <td>
        <div class="d-flex justify-content-end"><a class="btn btn-outline-primary" href="?open=Kategori-Add" target="_self">Tambah Data</a></div>
      </td>

    </tr>

    <tr>
      <td colspan="2">
        <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
            <th width="35" align="center" bgcolor="#CCCCCC">No</th>
            <th width="650" bgcolor="#CCCCCC">Nama Kategori</th>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
          </tr>
          <?php
          $mySql = "SELECT * FROM kategori ORDER BY nm_kategori ASC";
          $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
          $nomor  = 0;
          while ($myData = mysql_fetch_array($myQry)) {
            $nomor++;
            $Kode = $myData['kd_kategori'];
          ?>
            <tr>
              <td align="center"><?php echo $nomor; ?></td>
              <td><?php echo $myData['nm_kategori']; ?></td>
              <td width="44" align="center"><a href="?open=Kategori-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data" class="btn btn-sm btn-primary">Edit</a></td>
              <td width="44" align="center"><a class="btn btn-sm btn-outline-primary" href="?open=Kategori-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA KATEGORI INI ... ?')">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
  </table>
</div>