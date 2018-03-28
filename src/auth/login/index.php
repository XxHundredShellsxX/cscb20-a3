<?php
  //  include("config.php");
   session_start();
   
   if ($_SERVER["REQUEST_METHOD"] == "POST") {
      // username and password sent from form
      $username = $_POST['username'];
      $password = $_POST['password'];

      if ($username == "test@test" && $password == "test") {
        $_SESSION['user_id'] = $id;
        $_SESSION['user_login'] = $login;
        $_SESSION['user_name'] = $name;
      }
      
      // $sql = "SELECT id FROM admin WHERE username = '$myusername' and password = '$mypassword'";
      // $result = mysqli_query($db,$sql);
      // $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
      // $count = mysqli_num_rows($result);
      
      // // If result matched $myusername and $mypassword, table row must be 1 row
		
      // if($count == 1) {
      //    $_SESSION['login_user'] = $myusername;
      //    header("Location: welcome.php");
      // }else {
      //    $error = "Your Login Name or Password is invalid";
      // }
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