<?php
  include("../config.php");
  session_start();

  if (isset($_SESSION['token'])){
    header("Location:../../dashboard");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // UTORid and password sent from form
    $UTORid = $_POST['UTORid'];
    // hash pass with sha256
    $password = hash('sha256', $_POST['password']);
    // check login type
    if ($_POST['radios'] == 'student') {
      // generate query for students
      $sql = "select * from Students where utorid = '$UTORid' and pass = '$password'";
      // get result from sql query on db
      $result = mysqli_query($db, $sql);
      // get row from result
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // get number of rows from result
      $count = mysqli_num_rows($result);
      // check if only 1 entry matched
      if ($count == 1) {
        // get all the mark entries and save in session
        foreach($student_entries as $entry) {
          $_SESSION[$entry] = $row[$entry];
        }
        // generate md5 token and save in session
        $token = generateToken();
        $_SESSION['token'] = $token;
        // create query to update user with token
        $sql_update_token = "update Students set authToken = '$token' where utorid = '$UTORid'";
        mysqli_query($db, $sql_update_token);
        // set account type
        $_SESSION['account'] = $_POST['radios'];
        // finally redirect to dashboard
        header('Location:../../dashboard/', false);
      } else {
        alert("Wrong login");
      }
    } else if ($_POST['radios'] == 'instructor') {
      // generate query for students
      $sql = "select * from Instructors where utorid = '$UTORid' and pass = '$password'";
      // get result from sql query on db
      $result = mysqli_query($db, $sql);
      // get row from result
      $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
      // get number of rows from result
      $count = mysqli_num_rows($result);
      // check if only 1 entry matched
      if ($count == 1) {
        // get all the entries and save in session
        foreach($student_entries as $entry) {
          $_SESSION[$entry] = $row[$entry];
        }
        // generate md5 token and save in session
        $token = generateToken();
        $_SESSION['token'] = $token;
        // create query to update user with token
        $sql_update_token = "update Instructors set authToken = '$token' where utorid = '$UTORid'";
        mysqli_query($db, $sql_update_token);
        // set account type
        $_SESSION['account'] = $_POST['radios'];
        // finally redirect to dashboard
        header('Location:../../dashboard/', false);
      } else {
        alert("Wrong login");
      }
    }
  }

  if ($_GET['ref'] == "logout") {
    alert("Successfully logged out");
  }

  function generateToken() {
    return md5(uniqid(rand(), true));
  }

  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
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
      <h1>login to cscb20</h1>
      <form action="" method="POST">
        <div class="radio-toolbar">
          <input type="radio" id="student" name="radios" value="student" checked>
          <label for="student" id="student-label">student</label>

          <input type="radio" id="instructor" name="radios" value="instructor">
          <label for="instructor">instructor</label>

          <input type="radio" id="ta" name="radios" value="ta">
          <label for="ta" id="ta-label">t.a.</label>
        </div>
        <input type="text" name="UTORid" placeholder="UTORid" required>
        <input type="password" name="password" placeholder="password" required>
        <button>login</button>
      </form>
      <a href="../signup/">i don't have an account. signup.</a>
    </div>
  </body>
</html>