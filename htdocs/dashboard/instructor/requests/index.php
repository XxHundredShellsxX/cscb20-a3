<?php
  include("../../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token']) || $_SESSION['account'] != 'instructor'){
    header("Location:../../../auth/login");
  }

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $student_ids = array();
    // different way of getting instructor id depending on if instructor or TA
    $instructorId = ($_SESSION['account'] == 'instructor') ? $_SESSION['utorid'] : $_SESSION['instructorId'];
    $sql = "select * from Students where instructorId = '".$instructorId."' and verified = 0";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $student_ids[] = $row['utorid'];
    }
    $num_of_students = count($student_ids);
    for($student_index = 0; $student_index < $num_of_students; $student_index++) {
      $curr_student = $student_ids[$student_index];
      $radioID = 'approval_student'.$student_index;
      if($_POST[$radioID] == "approved"){
        $sql_update_token = "update Students set verified = 1 where utorid = '$curr_student'";
      }
      else{
        $sql_update_token = "delete from Students where utorid = '$curr_student'";
      }
      mysqli_query($db, $sql_update_token);
    }

    $ta_ids = array();
    $sql = "select * from Tas where instructorId = '".$instructorId."' and verified = 0";
    $result = mysqli_query($db, $sql);
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $ta_ids[] = $row['utorid'];
    }
    $num_of_tas = count($ta_ids);
    for($ta_index = 0; $ta_index < $num_of_tas; $ta_index++) {
      $curr_ta = $ta_ids[$ta_index];
      $radioID = 'approval_ta'.$ta_index;
      if($_POST[$radioID] == "approved"){
        $sql_update_token = "update Tas set verified = 1 where utorid = '$curr_ta'";
      }
      else{
        $sql_update_token = "delete from Tas where utorid = '$curr_ta'";
      }
      mysqli_query($db, $sql_update_token);
    }
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
  
    <title>Join Requests | CSCB20</title>
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
            <a href="../../<?php if ($_SESSION['account'] == 'instructor' or $_SESSION['account'] == 'ta') echo "instructor/" ?>remark/">
              <div class="nav-item">
                <h2><i class="feather icon-edit-1"></i>remark request</h2>
              </div>
            </a>
            <a href='./'>
              <div class='nav-item active'>
                <h2><i class='feather icon-user-plus'></i>join requests</h2>
              </div>
            </a>
            <a href="../../../auth/logout/">
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
          <h3>Disapprove</h3>
        </div>
        <?php
          $sql = "select * from Students where verified = 0 and instructorId = '".$_SESSION['utorid']."'";
          $result = mysqli_query($db, $sql);
          $count = 0;
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "
            <div class='mark'>
              <h3>".$row['utorid']."</h3>
              <h3>".$row['firstName']."</h3>
              <h3>".$row['lastName']."</h3>
              <h3>Student</h3>
              <input type='radio' name='approval_student".$count."' value='approved' checked='checked'>
              <input type='radio' name='approval_student".$count."' value='disapproved'>
            </div>
            ";
            $count += 1;
          }
          $sql = "select * from Tas where verified = 0 and instructorId = '".$_SESSION['utorid']."'";
          $result = mysqli_query($db, $sql);
          $count = 0;
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            echo "
            <div class='mark'>
              <h3>".$row['utorid']."</h3>
              <h3>".$row['firstName']."</h3>
              <h3>".$row['lastName']."</h3>
              <h3>Ta</h3>
              <input type='radio' name='approval_ta".$count."' value='approved' checked='checked'>
              <input type='radio' name='approval_ta".$count."' value='disapproved'>
            </div>
            ";
            $count += 1;
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