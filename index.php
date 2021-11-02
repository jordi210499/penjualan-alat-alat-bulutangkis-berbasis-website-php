<?php
session_start();
include_once "library/inc.connection.php";
include_once "library/inc.library.php";
?>
<html lang="en">

<head>
  <title>Marza Sport</title>
  <link href="style/styles_user.css" rel="stylesheet" type="text/css">
  <link href="style/button.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script language="JavaScript" src="js.popupWindow.js"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>

<body topmargin="3">
  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-light bg-primary fixed-top">
    <div class="container">
      <a class="navbar-brand" href="index.php">
        <h5 class="text-white">Marza Sport</h5>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item active">
            <a class="nav-link text-white" href="index.php">Beranda<span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link text-white" href="?open=Profil" target="_self">Profil</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Kategori
            </a>
            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
              <td height="18" align="center" valign="top">
                <table width="98%" border="0" align="center" cellpadding="4" cellspacing="0">
                  <?php
                  $mySql = "SELECT * FROM kategori ORDER BY nm_kategori";
                  $myQry = mysql_query($mySql, $koneksidb) or die("Query salah : " . mysql_error());
                  while ($myData = mysql_fetch_array($myQry)) {
                    $Kode = $myData['kd_kategori'];
                  ?>
                    <tr>
                      <td width="8%"><img src="images/dot.png" width="9" height="9"></td>
                      <td width="92%"><b> <?php echo "<a href=?open=Barang-Kategori&Kode=$Kode>$myData[nm_kategori]</a>"; ?> </b></td>
                    </tr>
                  <?php
                  }
                  ?>
                </table>
              </td>
            </div>

          <li class="nav-item">
            <a class="nav-link text-white" href="?open=Barang" target="_self">Barang</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="?open=Panduan" target="_self">Panduan</a>
          </li>

          <li class="nav-item">
            <a class="nav-link text-white" href="?open=Konfirmasi" target="_self">Konfirmasi</a>
          </li>

          </li>
        </ul>
        <form action="?open=Barang-Pencarian" method="post" name="form1" class="form-inline my-2 my-lg-0">
          <input name="txtKeyword" type="text" class="form-control mr-sm-2" placeholder="Cari Barang">
          <input type="submit" name="btnCari" value=" Cari " class="btn btn-outline-light my-2 my-sm-0">&nbsp;
        </form>


      </div>
    </div>
  </nav>
  <!--TUtup Navbar-->


  <!-- Carousel -->
  <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
      <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
      <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
    </ol>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/1.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/2.jpg" class="d-block w-100" alt="...">
      </div>
      <div class="carousel-item">
        <img src="images/3.jpg" class="d-block w-100" alt="...">
      </div>
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="sr-only">Next</span>
    </a>
  </div>
  <!-- Tutup Carousel-->

  <div class="container">
    <div class="row">
      <div class="col-xl-10">
        <!--barang utama -->
        <div class="container my-5">
          <div class="jumbotron">
            <?php include "buka_file.php"; ?>
          </div>
        </div>
        <!-- TUtup barang utama-->
      </div>
      <div class="col-xl-2 my-5">
        <?php include "login.php"; ?></td>
        <tr>
          <td height="22" align="center" valign="top">&nbsp;</td>
        </tr>
        <tr>
          <td align="center" valign="top">
            <p>&nbsp;</p>
            <p><img src="images/BCA-Bank-Logo-blue.png" width="130"></p>
            <p><img src="images/Logo-Bank-Mandiri-Blue-Background.png" width="130"></p>
          </td>
        </tr>
      </div>
    </div>
  </div>






















  <div class="footer">
    <p class="text-center font-weight-bolder">Copyright &copy; 2021 All rights reserved Marza Sport</p>
  </div>
</body>

</html>