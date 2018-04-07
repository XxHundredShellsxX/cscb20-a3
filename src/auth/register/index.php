<?php
  include("../config.php");
  session_start();

  if (isset($_SESSION['token'])){
    header("Location:../../dashboard");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // UTORid and password sent from form
    $UTORid = $_POST['UTORid'];
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $studentNumber = $_POST['studentnumber'];
    // hash pass with sha256
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmpassword'];

    if ($password != $confirmPassword) {
      alert("The passwords do not match");
    } else {
      $password = hash('sha256', $password);
      if ($_POST['radios'] == 'student') {
        $sql = "insert into Students values(0, '$UTORid', '$password', '$firstName', '$lastName', '$studentNumber', 'attarwa', 0, 0, 0, 0, 0, 0, 0, 0, 0, null)";
        if (mysqli_query($db, $sql)) {
          $_SESSION['utorid'] = $UTORid;
          $_SESSION['firstName'] = $firstName;
          $_SESSION['lastName'] = $lastName;
          $_SESSION['studentNumber'] = $studentNumber;
          $_SESSION['instructorId'] = "attarwa";
          header("Location:../login?ref=signup");
        } else {
          alert("An error occured when trying to sign up.");
        }
      } else {
        $sql = "insert into TAs values(0, '$UTORid', '$password', '$firstName', '$lastName', 'attarwa')";
        if (mysqli_query($db, $sql)) {
          $_SESSION['utorid'] = $UTORid;
          $_SESSION['firstName'] = $firstName;
          $_SESSION['lastName'] = $lastName;
          $_SESSION['studentNumber'] = $studentNumber;
          $_SESSION['instructorId'] = "attarwa";
          header("Location:../login?ref=signup");
        } else {
          alert("An error occured when trying to sign up.");
        }
      }
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

    <title>Register | CSCB20</title>
  </head>
  <body>
    <div id="center-container">
      <h1>register for cscb20</h1>
      <form action="" method="POST">
        <div class="radio-toolbar">
          <input type="radio" id="student" name="radios" value="student" checked>
          <label for="student" id="student-label">student</label>
          <input type="radio" id="ta" name="radios" value="ta">
          <label for="ta" id="ta-label">t.a.</label>
        </div>
        <input type="text" name="UTORid" placeholder="UTORid" required>
        <input type="number" name="studentnumber" placeholder="student number" required>
        <input type="text" name="firstname" placeholder="first name" required>
        <input type="text" name="lastname" placeholder="last name" required>
        <input type="password" name="password" placeholder="password" required>
        <input type="password" name="confirmpassword" placeholder="confirm password" required>
        <button>register</button>
      </form>
      <a href="../login/">i have an account. login.</a>
    </div>
  </body>
</html>