<?php
  include("../../auth/config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../../auth/login");
  }
  $mark = calculate_mark();
  function calculate_mark() {
    global $db;
    global $mark_entries;
    $sql = "select * from CourseDetails where courseCode='CSCB20'";
    $result = mysqli_query($db, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $mark = 0;
    foreach($mark_entries as $entry) {
      $mark += $_SESSION[$entry] * $row[$entry] * .01;
    }
    return $mark;
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
      <h1>your marks</h1>
      <h2>current mark: <?php echo $mark?>%</h2>
      <div class="overview">
        <div class="card">
          <h2>upcoming</h2>
          <h3>final exam</h3>
        </div>
        <div class="card">
          <h2>tutorial section</h2>
          <h3>tut 1</h3>
        </div>

      </div>
      <div class="student-assessments">
          <div class="whole c">
            <h3>Name</h3>
          </div>
          <div class="whole a">
            <h3>Practical</h3>
          </div>
          <div class="whole b">
            <h3>Quiz 1</h3>
          </div>
          <div class="whole a">
            <h3>Quiz 2</h3>
          </div>
          <div class="whole b">
            <h3>Quiz 3</h3>
          </div>
          <div class="whole a">
            <h3>Assignment 1</h3>
          </div>
          <div class="whole b">
            <h3>Assignment 2</h3>
          </div>
          <div class="whole a">
            <h3>Assignment 3</h3>
          </div>
          <div class="whole b">
            <h3>Midterm</h3>
          </div>
          <div class="whole a">
            <h3>Final</h3>
          </div>
      </div>
      <div class="student-marks">
          <div class="whole c">
            <h3>Grade</h3>
          </div>
          <div class="whole a">
            <h3><?php echo $_SESSION['practical'] ?>%</h3>
          </div>
          <div class="whole b">
          <h3><?php echo $_SESSION['quiz1'] ?>%</h3>
          </div>
          <div class="whole a">
          <h3><?php echo $_SESSION['quiz2'] ?>%</h3>
          </div>
          <div class="whole b">
          <h3><?php echo $_SESSION['quiz3'] ?>%</h3>
          </div>
          <div class="whole a">
          <h3><?php echo $_SESSION['a1'] ?>%</h3>
          </div>
          <div class="whole b">
          <h3><?php echo $_SESSION['a2'] ?>%</h3>
          </div>
          <div class="whole a">
          <h3><?php echo $_SESSION['a3'] ?>%</h3>
          </div>
          <div class="whole b">
          <h3><?php echo $_SESSION['midterm'] ?>%</h3>
          </div>
          <div class="whole a">
          <h3><?php echo $_SESSION['final'] ?>%</h3>
          </div>
      </div>

      
      <footer>
        <p><b>Made with <i class="feather icon-heart"></i> by Rikin Katyal & Sajid Rahman</b></p>
        <p><a href="https://www.utoronto.ca/" target="_">University of Toronto</a> | <a href="http://web.cs.toronto.edu/" target="_">U of T Department of Computer Science</a> | <a href="http://www.utsc.utoronto.ca/home/" target="_">UTSC</a> | <a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics" target="_">UTSC CMS</a> | <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs</a></p>
      </footer>
    </div>
  </div>
</body>
</html>