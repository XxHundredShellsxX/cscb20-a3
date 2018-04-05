<?php
  include("../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../../auth/login");
  }
  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $assessment = $_GET['assessment'];
    if (!$assessment) {
      header("Location:index.php?assessment=practical");
    }
    $current_mark = $_SESSION[$assessment];
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assessment = $_GET['assessment'];
    $current_mark = $_SESSION[$assessment];
    date_default_timezone_set('EST');
    $sql = "insert into Feedback values ('".$_SESSION['utorid']."', '".date("Y-m-d H:i:s")."','0', null, $current_mark, null, $assessment, \"".$_POST['remarkBody']."\")";
    echo $sql;
    if (mysqli_query($db, $sql)) {
      alert("Remark request successfully submitted");
    } else {
      alert("There was a problem submitting the remark request");
    }
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

    <script>
      function change_mark(assessment) {
        window.location = 'index.php?assessment=' + assessment.value;
      }
    </script>
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
            <a href="./">
              <div class="nav-item active">
                <h2><i class="feather icon-hash"></i>marks</h2>
              </div>
            </a>
            <a href="../feedback/">
              <div class="nav-item">
                <h2><i class="feather icon-clipboard"></i>feedback </h2>
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
      <h1>Remark Request</h1>
      <h2>Choose an assetment to submit for remark</h2>
      <div class="assesment-grade">
        <select name="assesments" id="assesments" onChange="change_mark(this)">
          <?php
            foreach($mark_entries as $entry) {
              $sql_update_token = "select * from Remarks where createdBy = '".$_SESSION['utorid']."' and assessment = '$entry'";
              $result = mysqli_query($db, $sql_update_token);
              $count = mysqli_num_rows($result);
              if ($count > 0) {
                continue;
              }
              if ($entry == $assessment) {
                $selected = "selected='selected'";
              } else {
                $selected = "";
              }
              echo "<option value='$entry' $selected>$entry</option>";
            }
          ?>
        </select>
        <p>your grade: <?php echo $current_mark ?>%</p>
      </div>
      <form action="" method="post">
        <div class="card">
          <h2>Explain your remark request here</h2>
          <textarea name="remarkBody" id="remarkBody" maxlength="2000"></textarea>
          <button>Submit Remark</button>
        </div>
      </form>
      <h1>Previous Remark Requests</h1>
      <?php
        $sql_update_token = "select * from Remarks where createdBy = '".$_SESSION['utorid']."'";
        $result = mysqli_query($db, $sql_update_token);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          if ($row['approved'] == 0) {
            $status = "pending";
          } else {
            $status = "reviewed";
          }
          echo "<div class='card'>";
          echo "<div class='assesment-grade'>";
          echo "<h2>remark for: ".$row['assessment']."</h2>";
          echo "<h2>current status: ".$status."</h2>";
          echo "</div>";
          echo $row['remarkBody'];
          echo "</div>";
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