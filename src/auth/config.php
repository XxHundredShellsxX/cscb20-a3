<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'root');
  define('DB_PASSWORD', 'root');
  define('DB_DATABASE', 'cscb20');
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  $mark_entries = ['firstName', 'lastName', 'studentNumber', 'instructorId', 'practical', 'quiz1', 'quiz2', 'quiz3', 'a1', 'a2', 'a3', 'midterm', 'final']
?>