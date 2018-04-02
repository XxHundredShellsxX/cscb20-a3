<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'root');
   define('DB_PASSWORD', 'root');
   define('DB_DATABASE', 'cscb20');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   $sql = "INSERT INTO Students
   values('bob333','Bob', 71)";
   mysql_select_db( 'mainDB' );
   $retval = mysqli_query($sql, $db);
   if(!$retval){
       echo "Could not create database"
   }

   echo "Table students createed\n";
   
?>