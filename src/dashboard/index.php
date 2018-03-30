<?php
  //  include("config.php");
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
  
    <title>Dashboard | CSCB20</title>
</head>
<body>
  <div id="container">
      <div id="sidebar">
          <div id="menu" class="round-button" onclick="toggleMenu()"><i class="feather icon-menu"></i></div>
          <h1>cscb20</h1>
          <h4>introduction to databases & web applications</h4>
          <nav>
            <a href="../">
              <div class="nav-item">
                <h2><i class="feather icon-home"></i>home</h2>
              </div>
            </a>
            <a href="./">
              <div class="nav-item active">
                <h2><i class="feather icon-layers"></i>dashboard</h2>
              </div>
            </a>
            <a href="../auth/logout/">
              <div class="nav-item">
                <h2><i class="feather icon-log-out"></i>logout</h2>
              </div>
            </a>
          </nav>
        </div>
    <div id="content">
      <h1>welcome back, <?php echo $_SESSION['name'] ?></h1>
      <h2>your overview</h2>
      <div class="overview">
        <div class="card">
          <h2>mark</h2>
          <h3>92%</h3>
        </div>
        <div class="card">
          <h2>upcoming</h2>
          <h3>final exam</h3>
        </div>
        <div class="card">
          <h2>tutorial section</h2>
          <h3>tut 1</h3>
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