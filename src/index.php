<?php

  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:./auth/login");
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <script src="js/index.js"></script>

  <link rel="stylesheet" type="text/css" href="css/feather.css">
  <link rel="stylesheet" type="text/css" href="css/index.css">

  <title>CSCB20 | UTSC Course Website</title>
</head>
<body>
  <div id="container">
    <div id="sidebar">
      <div id="menu" class="round-button" onclick="toggleMenu()"><i class="feather icon-menu"></i></div>
      <h1>cscb20</h1>
      <h4>introduction to databases & web applications</h4>
      <nav>
        <div class="nav-item active">
          <h2><i class="feather icon-home"></i>home</h2>
        </div>
        <a href="./dashboard">
          <div class="nav-item">
            <h2><i class="feather icon-monitor"></i>dashboard</h2>
          </div>
        </a>
        <a href="./files/syllabus.pdf" target="_">
          <div class="nav-item">
            <h2><i class="feather icon-file-text"></i>syllabus</h2>
          </div>
        </a>
        <a href="./assignments/index.php">
          <div class="nav-item">
            <h2><i class="feather icon-edit"></i>assignments</h2>
          </div>
        </a>
        <a href="./lectures/index.php">
          <div class="nav-item">
            <h2><i class="feather icon-folder"></i>lecture notes</h2>
          </div>
        </a>
        <a href="./labs/index.php">
          <div class="nav-item">
            <h2><i class="feather icon-clipboard"></i>labs</h2>
          </div>
        </a>
        <a href="./calendar/index.phpindex.php">
          <div class="nav-item">
            <h2><i class="feather icon-calendar"></i>calendar</h2>
          </div>
        </a>
        <div class="nav-item" onclick="toggleLinks()">
          <h2><i class="feather icon-external-link"></i>course links</h2>
        </div>
        <div id="course-links">
          <a href="https://markus.utsc.utoronto.ca/cscb20w18" target="_">
            <div class="nav-subitem">
              <h2>MarkUs</h2>
            </div>
          </a>
          <a href="https://piazza.com/class/jcpjjp5l4bywd" target="_">
            <div class="nav-subitem">
              <h2>Piazza</h2>
            </div>
          </a>
        </div>
        <a href="./software/index.php">
          <div class="nav-item">
            <h2><i class="feather icon-download-cloud"></i>course software</h2>
          </div>
        </a>
        <a href="./feedback/index.php">
          <div class="nav-item">
            <h2><i class="feather icon-message-square"></i>feedback</h2>
          </div>
        </a>
      </nav>
    </div>
    <div id="content">
      <h1>home</h1>
      <h2>course description</h2>
      <p>A practical introduction to databases and Web app development. Databases: terminology and applications; creating, querying and updating databases; the entity-relationship model for database design. Web documents and applications: static and interactive documents; Web servers and dynamic server-generated content; Web application development and interface with databases.</p>
      <h2>Prerequisite</h2>
      <p>Some experience with programming in an imperative language such as Python, Java or C.</p>
      <h2>Exclusion</h2>
      <p>This course may not be taken after - <i>or concurrently with</i> - any C- or D-level CSC course.</p>
      <h2>Instructor</h2>
      <p><b>Dr. Abbas Attarwala</b></p>
      <p><b>email:</b> <a href="mailto:">abbas.attarwala@mail.utoronto.ca</a></p>
      <p><b>office:</b> IC 478</p>
      <p><b>phone:</b> 555-555-5555</p>
      <p><b>lectures:</b> Monday, 9:00 am - 11:00 am in <i>SW 319</i></p>
      <p><b>office hours:</b> Monday, 11:30 am - 1:00 pm & Friday, 11:30 am - 1:00 pm</p>
      <footer>
        <p><b>Made with <i class="feather icon-heart"></i> by Rikin Katyal & Sajid Rahman</b></p>
        <p><a href="https://www.utoronto.ca/" target="_">University of Toronto</a> | <a href="http://web.cs.toronto.edu/" target="_">U of T Department of Computer Science</a> | <a href="http://www.utsc.utoronto.ca/home/" target="_">UTSC</a> | <a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics" target="_">UTSC CMS</a> | <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs</a></p>
      </footer>
    </div>
    <div id="notifications">
      <div id="bell" class="round-button" onclick="toggleNotifications()"><i class="feather icon-bell badge"></i></div>
      <div id="messages">
        <div class="card">
          <p><b>Reminder: </b> you have a quiz next week</p>
        </div>
        <div class="card">
          <p><b>Submit Early!</b> MarkUs can crash.</p>
        </div>
      </div>
    </div>
  </div>
</body>
</html>