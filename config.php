<?php
   define('DB_SERVER', 'localhost');
   define('DB_USERNAME', 'hackerG7');
   define('DB_PASSWORD', 'rc28727057');
   define('DB_DATABASE', 'gkgameplay');
   $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
   mysqli_set_charset($db,'UTF8');
?>