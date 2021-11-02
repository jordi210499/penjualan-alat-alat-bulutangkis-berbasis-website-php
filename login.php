<body>
  <table border="0" cellpadding="3" cellspacing="0" align="right">
    <?php
    if (!isset($_SESSION['SES_PELANGGAN'])) {
      // Jika belum Login, maka form Login ditampilkan
    ?>

      <form name="frmLogin" method="post" action="?open=Login-Validasi" class="table-bordered">
        <tr>
          <td height="22" align="center" bgcolor="#CCCCCC" class="none"><strong>LOGIN</strong></td>
        </tr>
        <tr>
          <td width="919" height="18"><b>Username : </b><br>
            <input name="txtUsername" type="text" size="20" maxlength="30" class="form-control form-control-sm" placeholder="Masukan Username">
          </td>
        </tr>
        <tr>
          <td height="18" bgcolor="#F5F5F5" class="py-1"> <b>Password :</b> <br>
            <input name="txtPassword" type="password" size="20" maxlength="30" class="form-control form-control-sm" placeholder="Masukan Password">
          </td>
        </tr>

        <tr>
          <td bgcolor="#F5F5F5"><input class="btn btn-block btn-dark btn-sm my-1" type="submit" name="btnLogin" value="Login" /></td>
        </tr>
        <tr>
          <td bgcolor="#F5F5F5">
            <a href="?open=Pelanggan-Baru" target="_self" class="btn btn-block btn-outline-dark btn-sm my-1 decoration-none"> Pendaftaran Baru </a></b>
          </td>
        </tr>
      </form>
    <?php
    } else {
      // Jika sudah Login, maka menu Pelanggan ditampilkan
    ?>



      <tr>
        <td width="20%" height="22" align="center" bgcolor="#CCCCCC" class="none"><b>TRANSAKSI</b></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><b> <img src="images/dot.png" width="9" height="9"> <a href="?open=Keranjang-Belanja" target="_self" class="text-decoration-none text-dark">Keranjang Belanja</a> </b></td>
      </tr>

      <tr>
        <td bgcolor="#F5F5F5"><b> <img src="images/dot.png" width="9" height="9"> <a href="?open=Transaksi-Tampil" target="_self" class="text-decoration-none text-dark">Tampil Transaksi </a> </b></td>
      </tr>
      <tr>
        <td bgcolor="#F5F5F5"><b> <img src="images/dot.png" width="9" height="9" /> <a href="login_out.php" target="_self" class="text-decoration-none text-dark">Logout</a></b></td>
      </tr>
    <?php } ?>
  </table>