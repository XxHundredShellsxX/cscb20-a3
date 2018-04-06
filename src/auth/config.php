<?php
  define('DB_SERVER', 'localhost');
  define('DB_USERNAME', 'katyalri');
  define('DB_PASSWORD', 'katyalri');
  define('DB_DATABASE', 'cscb20w18_katyalri');
  $db = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD, DB_DATABASE);

  $mark_entries = array('practical', 'quiz1', 'quiz2', 'quiz3', 'a1', 'a2', 'a3', 'midterm', 'final');
  $student_entries = array('utorid', 'firstName', 'lastName', 'studentNumber', 'instructorId', 'practical', 'quiz1', 'quiz2', 'quiz3', 'a1', 'a2', 'a3', 'midterm', 'final');
  $instructor_entries = array('utorid', 'firstName', 'lastName');

  function alert($msg) {
    echo "<script type='text/javascript'>alert('$msg');</script>";
  }
?>