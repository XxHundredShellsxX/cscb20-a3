<?php
  include("../../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../../../auth/login");
  }
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $assessment = $_GET['assessment'];
    $current_mark = $_SESSION[$assessment];
    $sql_update_grade = "update Students set ".$_GET['assessment']." = ".$_POST['updatedGrade']." where utorid='".$_GET['utorid']."'";
    $sql_update_remark = "update Remarks set approved = 1, approvedBy = '".$_SESSION['utorid']."', updatedGrade = ".$_POST['updatedGrade'].", remarkFeedback = '".$_POST['remarkFeedback']."' where createdBy = '".$_GET['utorid']."' and assessment = '".$_GET['assessment']."'";
    if (mysqli_query($db, $sql_update_grade) && mysqli_query($db, $sql_update_remark)) {
      alert("Remark request successfully updated");
    } else {
      alert("There was an error updating the remark request");
    }
    // $sql = "insert into Remarks values ('".$_SESSION['utorid']."', '".date("Y-m-d H:i:s")."','0', null, $current_mark, null, '$assessment', \"".$_POST['remarkBody']."\", null)";
    // if (mysqli_query($db, $sql)) {
    //   alert("Remark request successfully submitted");
    // } else {
    //   alert("There was a problem submitting the remark request");
    // }
  }
  function nl2p($text) {
    return '<p>'.str_replace(array("\r\n", "\r", "\n"), '</p><p>', $text).'</p>';
  }
?>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
    <script src="../../../js/index.js"></script>
  
    <link rel="stylesheet" type="text/css" href="../../../css/feather.css">
    <link rel="stylesheet" type="text/css" href="../../../css/index.css">
  
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
            <a href="../../../">
              <div class="nav-item">
                <h2><i class="feather icon-home"></i>home</h2>
              </div>
            </a>
            <a href="../../">
              <div class="nav-item">
                <h2><i class="feather icon-monitor"></i>dashboard</h2>
              </div>
            </a>
            <a href="../marks">
              <div class="nav-item">
                <h2><i class="feather icon-hash"></i>marks</h2>
              </div>
            </a>
            <! only let students and instructor have access to feedback page !>
            <?php 
              if ($_SESSION['account'] != 'ta'){
                echo "
                <a href='../../feedback'>
                  <div class='nav-item'>
                    <h2><i class='feather icon-clipboard'></i>feedback</h2>
                  </div>
                </a>
                ";
              }
            ?>
            <a href='./'>
              <div class="nav-item active">
                <h2><i class="feather icon-edit-1"></i>remark request</h2>
              </div>
            </a>
            <?php 
              if ($_SESSION['account'] == 'instructor'){
                echo "
                <a href='../requests'>
                  <div class='nav-item'>
                    <h2><i class='feather icon-user-plus'></i>join requests</h2>
                  </div>
                </a>
                ";
              }
            ?>
            <a href="../../../auth/logout/">
              <div class="nav-item">
                <h2><i class="feather icon-log-out"></i>logout</h2>
              </div>
            </a>
          </nav>
        </div>
    <div id="content">
      <h1>Remark Request</h1>
      <h2>current remark requests</h2>
      <?php
        $sql = "select * from Remarks where approved = 0";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<form action='index.php?utorid=".$row['createdBy']."&assessment=".$row['assessment']."' method='post'>";
          echo "<div class='card remark'>";
          echo "<div class='assesment-grade'>";
          echo "<h2>student utorid: ".$row['createdBy']."</h2>";
          echo "<h2>remark for: ".$row['assessment']."</h2>";
          echo "<h2>original mark: ".$row['originalGrade']."%</h2>";
          echo "<h2>update mark: </h2><input type='number' name='updatedGrade' value='".$row['originalGrade']."' />";
          if ($row['approved'] == 0) {
            $status = "pending";
            $feedback = "";
          } else {
            $status = "completed";
            $feedback = "<h2>Remarked by ".$row['approvedBy']."</h2>".nl2p($row['remarkFeedback']);
            echo "<h2>updated mark: ".$row['updatedGrade']."%</h2>";
          }
          echo "</div>";
          echo "<h2>Student remark description:</h2>";
          echo nl2p($row['remarkBody']);
          echo $feedback;
          echo "<textarea placeholder='Enter a response for the request.' name='remarkFeedback' required></textarea>";
          echo "<button>Resolve</button>";
          echo "</div>";
          echo "</form>";
        }
      ?>
      <h2>Previous Remark Requests</h2>
      <?php
        $sql = "select * from Remarks where approved = 1";
        $result = mysqli_query($db, $sql);
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
          echo "<div class='card remark'>";
          echo "<div class='assesment-grade'>";
          echo "<h2>student utorid: ".$row['createdBy']."</h2>";
          echo "<h2>remark for: ".$row['assessment']."</h2>";
          echo "<h2>original mark: ".$row['originalGrade']."%</h2>";
          if ($row['approved'] == 0) {
            $status = "pending";
            $feedback = "";
          } else {
            $status = "completed";
            $feedback = "<h2>Remarked by ".$row['approvedBy']."</h2>".nl2p($row['remarkFeedback']);
            echo "<h2>updated mark: ".$row['updatedGrade']."%</h2>";
          }
          echo "<h2>status: ".$status."</h2>";
          echo "</div>";
          echo "<h2>Student remark description:</h2>";
          echo nl2p($row['remarkBody']);
          echo $feedback;
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