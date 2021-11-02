<?php
session_start();
include_once "../library/inc.connection.php";
include_once "../library/inc.library.php";
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <title>admin</title>
  <link href="../style/button.css" rel="stylesheet" type="text/css">
  <link rel="stylesheet" type="text/css" href="../plugins/tigra_calendar/tcal.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
  <script type="text/javascript" src="../plugins/tigra_calendar/tcal.js"></script>
  <script language="javascript" type="text/javascript" src="../plugins/tinymce/tinymce.min.js"></script>
  <script type="text/javascript">
    tinymce.init({
      selector: "textarea"
    });
  </script>
</head>

<body>
  <?php include "menu.php"; ?>

  &nbsp; <?php include "buka_file.php"; ?>

</body>

</html>