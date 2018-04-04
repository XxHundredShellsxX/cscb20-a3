<?php
  include("../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../../auth/login");
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    date_default_timezone_set('EST');
    $sql = "insert into Feedback values (\"".$_POST['feedback']."\", '".date("Y-m-d H:i:s")."','".$_POST['instructors']."')";
    if (mysqli_query($db, $sql)) {
      alert("Feedback successfully sent");
    } else {
      alert("An unexpected error occured. Please try again.");
    }
  }

  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
?>
<html lang="en">
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
  <div id="container">
      <div id="sidebar">
          <div id="menu" class="round-button" onclick="toggleMenu()"><i class="feather icon-menu"></i></div>
          <h1>cscb20</h1>
          <h4>introduction to databases & web applications</h4>
          <nav>
            <a href="../../">
              <div class="nav-item">
                <h2><i class="feather icon-home"></i>home</h2>
              </div>
            </a>
            <a href="../">
              <div class="nav-item">
                <h2><i class="feather icon-monitor"></i>dashboard</h2>
              </div>
            </a>
            <a href="../<?php if ($_SESSION['account'] == 'instructor') echo "instructor/" ?>marks/">
              <div class="nav-item">
                <h2><i class="feather icon-hash"></i>marks</h2>
              </div>
            </a>
            <a href="./">
              <div class="nav-item active">
                <h2><i class="feather icon-clipboard"></i>feedback</h2>
              </div>
            </a>
            <a href="../../auth/logout/">
              <div class="nav-item">
                <h2><i class="feather icon-log-out"></i>logout</h2>
              </div>
            </a>
          </nav>
        </div>
    <div id="content">
      <?php
        if ($_SESSION['account'] == 'instructor') {
          echo "<h1>view feedback</h1>
          <h2>this is the feedback submitted completely anonymously.</h2>
          <div class='feedbacks'>";
          $sql = "select * from Feedback where instructorId = '".$_SESSION['utorid']."'";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<div class='feedback card'>
            <h2>Submitted at ".$row['submittedAt']."</h2>
            <p>".$row['body']."</p>
            </div>";
          }
          echo '</div>';
        } else if ($_SESSION['account'] == 'student') {
          echo "<h1>submit feedback</h1>
          <h2>this feedback is submitted completely anonymously.</h2>
          <form action='' method='post'>
            <div class='card'>
              <h2>feedback</h2>
              <select name='instructors'>";
          $sql = "select * from Instructors";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "<option value='".$row['utorid']."'>".$row['firstName']." ".$row['lastName']."</option>";
          }
          echo "</select>
              <textarea maxlength='2000' name='feedback' required>What do you like about the instructor teaching?

What do you recommend the instructor to do to improve their teaching?

What do you like about the labs?

What do you recommend the lab instructors to do to improve their lab teaching?

Any other feedback to send?
</textarea>
              <button>Submit</button>
            </div>
          </form>";
        }
      ?>
      <footer>
        <p><b>Made with <i class="feather icon-heart"></i> by Rikin Katyal & Sajid Rahman</b></p>
        <p><a href="https://www.utoronto.ca/" target="_">University of Toronto</a> | <a href="http://web.cs.toronto.edu/" target="_">U of T Department of Computer Science</a> | <a href="http://www.utsc.utoronto.ca/home/" target="_">UTSC</a> | <a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics" target="_">UTSC CMS</a> | <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs</a></p>
      </footer>
    </div>
  </div>
</body>
</html>