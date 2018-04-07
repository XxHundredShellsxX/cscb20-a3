<?php
  include("../../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token']) || $_SESSION['account'] == 'student'){
    header("Location:../../../auth/login");
  }
  $student_ids = array();
  // different way of getting instructor id depending on if instructor or TA
  $instructorId = ($_SESSION['account'] == 'instructor') ? $_SESSION['utorid'] : $_SESSION['instructorId'];
  $sql = "select * from Students where instructorId = '".$instructorId."'";
  $result = mysqli_query($db, $sql);
  while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
      $student_ids[] = $row['utorid'];
  }
  $num_of_students = count($student_ids);
  $num_of_marks = count($mark_entries);
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $update_success = true;
    for($student_index = 0; $student_index < $num_of_students; $student_index++) {
      for($mark_index = 0; $mark_index < $num_of_marks; $mark_index++) {
        $curr_student = $student_ids[$student_index];
        $assessment = $mark_entries[$mark_index];
        $new_mark = $_POST['marks'][($student_index * ($num_of_marks)) + $mark_index];
        $sql_update_token = "update Students set $assessment = $new_mark where utorid = '$curr_student'";
        if (!mysqli_query($db, $sql_update_token)) {
          $update_success = false;
        }
      }
    }
    if ($update_success) {
      alert("Marks successfully updated.");
    }
  }
  $class_avg = calculate_class_avg();
  function calculate_class_avg() {
    global $db;
    global $mark_entries;
    $sql = "select * from CourseDetails where courseCode='CSCB20'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $average = 0;
    // find total of every assessment
    foreach($mark_entries as $entry) {
      $average += assessment_avg($entry) * $row[$entry] * .01;
    }
    return round($average, 2);
  }
  function assessment_avg($assessment){
    global $db;
    // different way of getting instructor id depending on if instructor or TA
    $instructorId = ($_SESSION['account'] == 'instructor') ? $_SESSION['utorid'] : $_SESSION['instructorId'];
    $sql = "select * from Students where verified = 1 and instructorId = '".$instructorId."'";
    $result = mysqli_query($db, $sql);
    $total = 0;
    $count = 0;
    while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
        $total += $row[$assessment];
        $count += 1;
        
    }
    return $total / $count;
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
            <a href="./">
              <div class="nav-item active">
                <h2><i class="feather icon-hash"></i>marks</h2>
              </div>
            </a>
            <!-- only let students and instructor have access to feedback page -->
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
      <h1>class marks</h1>
      <h2>class average: <?php echo $class_avg?>%</h2>
      <form action="" method="post" class="instructor-marks">
        <div class="mark">
          <h3>UTORid</h3>
          <h3>Name</h3>
          <h3>Practical</h3>
          <h3>quiz 1</h3>
          <h3>quiz 2</h3>
          <h3>quiz 3</h3>
          <h3>A1</h3>
          <h3>A2</h3>
          <h3>A3</h3>
          <h3>Midterm</h3>
          <h3>Final</h3>
        </div>
        <?php
          // different way of getting instructor id depending on if instructor or TA
          $instructorId = ($_SESSION['account'] == 'instructor') ? $_SESSION['utorid'] : $_SESSION['instructorId'];
          $sql = "select * from Students where instructorId = '".$instructorId."'";
          $result = mysqli_query($db, $sql);
          while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            if ($row['verified'] == "1") {
                $mark_str = "";
                foreach($mark_entries as $entry){
                    
                      $mark_str = $mark_str."<input type='number' min='0' max='100' name='marks[]' value='".$row[$entry]."'/>";
            
                }
                echo "
                <div class='mark entry ".$verfied_status."' id=".$row['utorid'].">
                  <h3>".$row['utorid']."</h3>
                  <h3>".$row['firstName']." ".$row['lastName']."</h3>
                  ".$mark_str."
                </div>
                ";
            }
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