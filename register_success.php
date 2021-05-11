<?php
   session_start();
?>
<!DOCTYPE html>
<html style="background-image:none; background-color:rgba(0,0,0,0)">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-image:none; background-color:rgba(0,0,0,0);">
<div class="bg-image", id="bg-image"></div>
<div class="register-form" style="width:50%;height:50%;">
   <div style = "background-color:rgba(0,0,0,0.2);width:100%;height:100%; border: solid 1px #333333;overflow:auto " align = "center">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>成功創建帳號</b></div>
         <h2 style="font-size:1.5vw;color:white">驗證郵件已經發過去你的郵箱了，請檢查~</h2>
         <h2 style="font-size:1.5vw;color:white"><?php echo $_GET["email"] ?></h2>
         <h2 style="font-size:1.5vw;color:white">*注意*: 找不到的話通常是被系統誤認成垃圾郵件 尤其是Gmail</h2>
         <a href="login.php" style="color:lime">點我<a><a style="color:white">回到登入頁面</a>
      <div style = "margin:30px;color:white">
         
         
      </div>
      
   </div>
   
</div>
</body>
</html>