<div class="container">
  <table class="table table-striped">
    <tr>
      <h1 class="text-center">DATA PROVINSI</h1>
    </tr>
    <tr>
      <div class="d-flex justify-content-end">
        <a class="btn btn-outline-primary" href="?open=Provinsi-Add" target="_self">Tambah Data</a>
      </div>
      <br>

    </tr>
    <tr>
      <td colspan="2">
        <table class="table-list" width="100%" border="0" cellspacing="1" cellpadding="2">
          <tr>
            <th width="28" align="center" bgcolor="#CCCCCC"><strong>No</strong></th>
            <th width="333" bgcolor="#CCCCCC"><strong>Nama Provinsi </strong></th>
            <th width="216" align="right" bgcolor="#CCCCCC"><strong>Biaya Kirim (Rp) </strong></th>
            <td colspan="2" align="center" bgcolor="#CCCCCC"><strong>Tools</strong></td>
          </tr>
          <?php
          $mySql = "SELECT * FROM provinsi ORDER BY nm_provinsi ASC";
          $myQry = mysql_query($mySql, $koneksidb)  or die("Query salah : " . mysql_error());
          $nomor = 0;
          while ($myData = mysql_fetch_array($myQry)) {
            $nomor++;
            $Kode = $myData['kd_provinsi'];
          ?>
            <tr>
              <td align="center"><?php echo $nomor; ?></td>
              <td><?php echo $myData['nm_provinsi']; ?></td>
              <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo format_angka($myData['biaya_kirim']); ?></td>
              <td width="67" align="center"><a class="btn btn-sm btn-primary" href="?open=Provinsi-Edit&Kode=<?php echo $Kode; ?>" target="_self" alt="Edit Data">Edit</a></td>
              <td width="74" align="center"><a class="btn btn-sm btn-outline-primary" href="?open=Provinsi-Delete&Kode=<?php echo $Kode; ?>" target="_self" alt="Delete Data" onclick="return confirm('ANDA YAKIN INGIN MENGHAPUS DATA PROVINSI INI ... ?')">Delete</a></td>
            </tr>
          <?php } ?>
        </table>
      </td>
    </tr>
  </table>
</div>