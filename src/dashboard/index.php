<?php
  //  include("config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../auth/login");
  }
?>
<html>
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <script src="../../js/index.js"></script>

    <link rel="stylesheet" type="text/css" href="../../css/feather.css">
    <link rel="stylesheet" type="text/css" href="../../css/index.css">

    <title>Dashboard | CSCB20</title>
  </head>
  <body>
    <div id="center-container">
      <?php 
        # get name
        echo "<h1>Welcome Rikin</h1>";
      ?>
    </div>
  </body>
</html>