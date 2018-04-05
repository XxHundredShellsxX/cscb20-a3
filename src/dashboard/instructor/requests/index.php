<?php
  include("../../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token']) || $_SESSION['account'] != 'instructor'){
    header("Location:../../../../auth/login");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    foreach ($_POST['approval_student'] as $approval_student) {
      $sql_update_token = "update Students set verified = 1 where utorid = '$approval_student'";
      mysqli_query($db, $sql_update_token);
    }
    foreach ($_POST['approval_ta'] as $approval_ta) {
      $sql_update_token = "update TAs set verified = 1 where utorid = '$approval_ta'";
      mysqli_query($db, $sql_update_token);
    }
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <script src="../../../../js/index.js"></script>
  
    <link rel="stylesheet" type="text/css" href="../../../../css/feather.css">
    <link rel="stylesheet" type="text/css" href="../../../../css/index.css">
  
    <title>Join Requests | CSCB20</title>
</head>
<body>
  <div id="container">
      <div id="sidebar">
          <div id="menu" class="round-button" onclick="toggleMenu()"><i class="feather icon-menu"></i></div>
          <h1>cscb20</h1>
          <h4>introduction to databases & web applications</h4>
          <nav>
            <a href="../../../../">
              <div class="nav-item">
                <h2><i class="feather icon-home"></i>home</h2>
              </div>
            </a>
            <a href="../../">
              <div class="nav-item">
                <h2><i class="feather icon-monitor"></i>dashboard</h2>
              </div>
            </a>
            <a href="../marks/">
              <div class="nav-item">
                <h2><i class="feather icon-hash"></i>marks</h2>
              </div>
            </a>
            <a href="../../../../auth/logout/">
              <div class="nav-item">
                <h2><i class="feather icon-log-out"></i>logout</h2>
              </div>
            </a>
          </nav>
        </div>
    <div id="content">
      <h1>join requests</h1>
      <form action="" method="post">
        <div class="mark">
          <h3>UTORid</h3>
          <h3>First Name</h3>
          <h3>Last Name</h3>
          <h3>Account</h3>
          <h3>Approve</h3>
        </div>
        <?php
          $sql = "select * from Students where verified = 0 and instructorId = '".$_SESSION['utorid']."'";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "
            <div class='mark'>
              <h3>".$row['utorid']."</h3>
              <h3>".$row['firstName']."</h3>
              <h3>".$row['lastName']."</h3>
              <h3>Student</h3>
              <input type='checkbox' name='approval_student[]' value='".$row['utorid']."'>
            </div>
            ";
          }
          $sql = "select * from TAs where verified = 0 and instructorId = '".$_SESSION['utorid']."'";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "
            <div class='mark'>
              <h3>".$row['utorid']."</h3>
              <h3>".$row['firstName']."</h3>
              <h3>".$row['lastName']."</h3>
              <h3>TA</h3>
              <input type='checkbox' name='approval_ta[]' value='".$row['utorid']."'>
            </div>
            ";
          }
        ?>
        <button>Save Changes</button>
      </form>
      <footer>
        <p><b>Made with <i class="feather icon-heart"></i> by Rikin Katyal & Sajid Rahman</b></p>
        <p><a href="https://www.utoronto.ca/" target="_">University of Toronto</a> | <a href="http://web.cs.toronto.edu/" target="_">U of T Department of Computer Science</a> | <a href="http://www.utsc.utoronto.ca/home/" target="_">UTSC</a> | <a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics" target="_">UTSC CMS</a> | <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs</a></p>
      </footer>
    </div>
  </div>
</body>
</html>