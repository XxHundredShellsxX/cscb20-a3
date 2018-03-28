<?php
  //  include("config.php");
   session_start();
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($username == "test" && $password == "test") {
        $_SESSION['username'] = $username;
        $_SESSION['token'] = generateToken();
      }
   }

   function generateToken() {
     return md5(uniqid(rand(), true));
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

    <title>Login | CSCB20</title>
  </head>
  <body>
    <div id="center-container">
      <h1>Login to CSCB20</h1>
      <form action="" method="POST">
        <input type="text" name="username" placeholder="Username" required>
        <input type="password" placeholder="Password" required>
        <button>Login</button>
      </form>
    </div>
  </body>
</html>