<?php
   include("config.php");
   $c = mysqli_real_escape_string($db,$_GET["randomCode"]);
   $sql = "SELECT username,email_activated FROM users WHERE randomCode = '$c'";
   $result = mysqli_query($db,$sql);
   if (!$result) {
      printf("Error: %s\n", mysqli_error($db));
      exit();
   }
   $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);
   
?>

<html style="background-image:none; background-color:rgba(0,0,0,0)">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-image:none; background-color:rgba(0,0,0,0);">
<div class="bg-image", id="bg-image"></div>
<div class="register-form" style="width:50%;height:50%;">
   <div style = "background-color:rgba(0,0,0,0.2);width:100%;height:100%; border: solid 1px #333333;overflow:auto " align = "center">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b><?php
      if($count > 0){
         if(!$rows["email_activated"]){
            echo '郵箱認證成功';
            $sql = "UPDATE users SET email_activated=1, money=money+1000 WHERE username='".$rows["username"]."'";
            $result = mysqli_query($db,$sql);
            if (!$result) {
               printf("Error: %s\n", mysqli_error($db));
               exit();
            }
         }else{
            echo "郵箱已經認證";
         }
      }else{
         echo '郵箱認證失敗';
      }
      ?></b></div>
         <?php 
         
         if($count > 0 && !$rows["email_activated"]){
            echo '<h2 style="font-size:1.5vw;color:white">你的郵箱已經成功被認證了!獎勵你1000枚金幣哦~</h2>';
         }
         ?>
         <a href="/php/welcome.php" style="color:lime">點我<a><a style="color:white">回到首頁</a>
      <div style = "margin:30px;color:white">
         
         
      </div>
      
   </div>
   
</div>
</body>
</html>