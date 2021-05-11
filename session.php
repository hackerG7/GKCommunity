<?php
   include('config.php');
   session_start();
   $_SESSION["previous_url"] = $_SERVER['REQUEST_URI'];
   $user_check = $_SESSION['login_user'];
   
   $ses_sql = mysqli_query($db,"select * from users where username = '$user_check' ");
   
   $row = mysqli_fetch_array($ses_sql,MYSQLI_ASSOC);
   
   $login_session = $row['username'];
   $_SESSION["userData"] = $row;
   $_SESSION["login"]=isset($_SESSION['login_user']);
   
   function get_displayName(){
      return $_SESSION["userData"]["displayName"];
   }
   if(!$_SESSION["login"]){
      header("location:/php/login.php");
      die();
   }
   
?>