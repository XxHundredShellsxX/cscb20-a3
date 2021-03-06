<?php
  include("../auth/config.php");
  session_start();
  if (!isset($_SESSION['token'])){
    header("Location:../auth/login");
  }
?>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  
  <script src="../js/index.js"></script>

  <link rel="stylesheet" type="text/css" href="../css/feather.css">
  <link rel="stylesheet" type="text/css" href="../css/index.css">

  <title>Software | CSCB20</title>
</head>
<body>
  <div id="container">
      <div id="sidebar">
          <div id="menu" class="round-button" onclick="toggleMenu()"><i class="feather icon-menu"></i></div>
          <h1>cscb20</h1>
          <h4>introduction to databases & web applications</h4>
          <nav>
            <a href="../index.php">
              <div class="nav-item">
                <h2><i class="feather icon-home"></i>home</h2>
              </div>
            </a>
            <a href="../dashboard/index.php">
                <div class="nav-item">
                    <h2><i class="feather icon-monitor"></i>dashboard</h2>
                </div>
            </a>
            <a href="../files/syllabus.pdf" target="_">
              <div class="nav-item">
                <h2><i class="feather icon-file-text"></i>syllabus</h2>
              </div>
            </a>
            <a href="../assignments/index.php">
              <div class="nav-item">
                <h2><i class="feather icon-edit"></i>assignments</h2>
              </div>
            </a>
            <a href="../lectures/index.php">
              <div class="nav-item">
                <h2><i class="feather icon-folder"></i>lecture notes</h2>
              </div>
            </a>
            <a href="../labs/index.php">
              <div class="nav-item">
                <h2><i class="feather icon-clipboard"></i>labs</h2>
              </div>
            </a>
            <a href="../calendar/index.php">
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
              <div class="nav-item active">
                <h2><i class="feather icon-download-cloud"></i>course software</h2>
              </div>
            <a href="../feedback/index.php">
              <div class="nav-item">
                <h2><i class="feather icon-message-square"></i>feedback</h2>
              </div>
            </a>
          </nav>
        </div>
    <div id="content">
      <h1>course software</h1>
      <h2>overview</h2>
      <p>Here you can find the download links for all the software you will need for this course. Some of these software are not required, although highly recommended.</p>
      <a href="https://www.mysql.com/downloads/" target="_"><h5>MySQL</h5></a>
      <p>MySQL is an open-source relational database management system which uses the Structured Query Language</p>
      <a href="https://sequelpro.com/download" target="_"><h5>Sequel Pro (Mac)</h5></a>
      <p>Sequel Pro is a fast, easy-to-use Mac database management application for working with MySQL databases.</p>
      <a href="https://razorsql.com/download.html" target="_"><h5>RazorSQL</h5></a>
      <p>RazorSQL is an SQL query tool, database browser, SQL editor, and database administration tool for Windows, macOS, Mac OS X, Linux, and Solaris.</p>
      <a href="https://atom.io/" target="_"><h5>Atom</h5></a>
      <p>Atom is a hackable text editor for the 21st Century which you can use to develop websites with.</p>
      <footer>
        <p><b>Made with <i class="feather icon-heart"></i> by Rikin Katyal & Sajid Rahman</b></p>
        <p><a href="https://www.utoronto.ca/" target="_">University of Toronto</a> | <a href="http://web.cs.toronto.edu/" target="_">U of T Department of Computer Science</a> | <a href="http://www.utsc.utoronto.ca/home/" target="_">UTSC</a> | <a href="https://www.utsc.utoronto.ca/cms/computer-science-mathematics-statistics" target="_">UTSC CMS</a> | <a href="http://www.utsc.utoronto.ca/labs/"> UTSC Labs</a></p>
      </footer>
    </div>
  </div>
</body>
</html>