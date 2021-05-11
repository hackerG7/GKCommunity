<?php
   
   include("config.php");
   session_start();
   $usernameError = "";
   $passwordError = "";
   $emailError = "";
   $error = "";
   function createRandomCode() { 

      $chars = "abcdefghijkmnopqrstuvwxyz023456789"; 
      srand((double)microtime()*1000000); 
      $i = 0; 
      $pass = '' ; 
  
      while ($i <= 7) { 
          $num = rand() % 33; 
          $tmp = substr($chars, $num, 1); 
          $pass = $pass . $tmp; 
          $i++; 
      } 
  
      return $pass; 
  
  } 
   if(isset($_GET["submit"])){//$_SERVER["REQUEST_METHOD"] == "GET") {
      // username and password sent from form 
      $myusername = mysqli_real_escape_string($db,$_GET['username']);
      $mypassword = mysqli_real_escape_string($db,$_GET['password']); 
      $REpassword = mysqli_real_escape_string($db,$_GET['REpassword']); 
      $displayName = mysqli_real_escape_string($db,$_GET['displayName']); 
      $gender = mysqli_real_escape_string($db,$_GET['gender']); 
      $email = mysqli_real_escape_string($db,$_GET['email']); 
      $sameUsernameResult = mysqli_query($db,"SELECT username FROM users WHERE username='".$myusername."';");
      $rejectUsername = mysqli_num_rows($sameUsernameResult)>0;
      $failed = false;
      $notEmpty = !empty($myusername)&&!empty($mypassword)&&!empty($REpassword)&&!empty($displayName)&&!empty($gender)&&!empty($email);
      if($notEmpty){
         if($rejectUsername){
            $usernameError="username has been taken";
            $failed = true;
         }
         $sameEmailResult = mysqli_query($db,"SELECT username FROM users WHERE email='".$email."';") && !isset($_SESSION["register_platform"]);
         $rejectEmail = mysqli_num_rows($sameEmailResult)>0; 
         if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $emailError = "Invalid email format"; 
            $failed = true;
         }else if($rejectEmail){
            $emailError="this email has been already used";
            $failed = true;
         }
         if($mypassword!=$REpassword){
            $passwordError="the passwords are not the same";
            $failed = true;
         }
         if(!$rejectUsername){
            if(!$failed){
               if(!isset($_SESSION["register_platform"])){
                  $sql = "INSERT INTO `users` (`userID`, `displayName`, `username`, `password`, `gender`, `email`, `money`) VALUES (NULL,'".$displayName."', '".$myusername."', '".$mypassword."', '".$gender."', '".$email."', '0')";
               }else{
                  $sql = "INSERT INTO `users` (`userID`,`platform` ,`displayName`, `username`, `password`, `gender`, `email`, `money`) VALUES (NULL,'".$_SESSION['register_platform']."','".$displayName."', '".$myusername."', '".$mypassword."', '".$gender."', '".$email."', '0')";
                  unset($_SESSION["register_platform"]);
               }
               $result = mysqli_query($db,$sql);
               if (!$result) {
                  $error = mysqli_error($db);
                  printf("Error: %s\n", mysqli_error($db));
                  exit();
               }else{
                  $sql = "SELECT userID FROM users WHERE username='$myusername'";
                  $userResult = mysqli_query($db,$sql);
                  if (!$userResult) {
                     printf("Error: %s\n", mysqli_error($db));
                     exit();
                  }else{
                     $row = mysqli_fetch_array($userResult,MYSQLI_ASSOC);
                     $userID = $row["userID"];
                     $code = createRandomCode().$userID;
                     $updateResult = mysqli_query($db,"UPDATE users SET randomCode='$code' WHERE username='$myusername'");
                     if(!$updateResult){
                        printf("Error: %s\n", mysqli_error($db));
                        exit();
                     }
                     $to = $email;
                     $subject = "GK Community";
                     require "phpMailer/PHPMailerAutoload.php";
                     $mail = new PHPMailer;
                     $mail->Host="smtp.gmail.com";
                     $mail->Port=587;
                     $mail->SMTPAuth=true;
                     $mail->SMTPSecure="tls";

                     $mail->Username="gkgameplaycommunity@gmail.com";
                     $mail->Password="28727057";
                     $mail->setFrom("gkgameplaycommunity@gmail.com","GKGAMEPLAY");
                     $mail->addAddress($to);
                     $mail->addReplyTo("gkgameplaycommunity@gmail.com");
                     $mail->isHTML(true);
                     $mail->Subject=$subject;
                     $mail->Body="
                     
                     <div style='background-color:black; color:white; font-size:30px;border:lime solid 5px;padding:15px;'>
                     <h2 align=center>激活GK Community(不是詐騙(〃＞皿＜))</h2>
                     <div style='background-color:rgb(0,0,0);padding:15px;border:white dashed 5px;'>
                     <p style='color:white'>Dear $myusername ,<br><br>Welcome to GK ━(*｀∀´*)ノ <br> go to this website to verify your email. <br><br></p> <a style='color:lime' href='https://gkgameplay.tk/php/activate_email.php?randomCode=$code'>click me</a> <br><br><p style='color:white'> Remember you should not share this url with other.
                        <br>------------------------------------------<br>歡迎你加入GK哦━(*｀∀´*)ノ <br> 點擊這個網址來認證激活你的帳號 <br><br> </p><a style='color:lime' href='https://gkgameplay.tk/php/activate_email.php?randomCode=$code'>點我激活  </a> <br><br><p style='color:white'> 請謹記不要隨意把這個網址分享給別人.
                        <br><br>Yours truly,<br>GKGAMEPLAY</p>
                     </div>
                     </div>
";
                     if(!$mail->send()){
                        echo "message could not be sent";
                     }else{
                        header("location: /php/register_success.php?email=$email");
                     }
                  }
               }

            }else{
               $error="your passwords are not the same!";
            }
         }else{
            $error="username has been already taken";
         }
      }else{
         $error = "please don't leave any empty";
      }
   }
?>
<!DOCTYPE html>
<html style="background-image:none; background-color:rgba(0,0,0,0)">
<head>
<link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body style="background-image:none; background-color:rgba(0,0,0,0);">
<div class="bg-image", id="bg-image"></div>
<div class="register-form">
   <div style = "background-color:rgba(0,0,0,0.2);width:100%;height:100%; border: solid 1px #333333;overflow:auto " align = "center">
      <div style = "background-color:#333333; color:#FFFFFF; padding:3px;"><b>Register</b></div>
      
      <div style = "margin:30px;color:white">
         
         <form action = "" method = "GET" align = "left">
            <label>帳號  : </label><input type = "text" name = "username" class = "inputbox"/><?php echo "<c>".$usernameError."</c>"; ?><br>
            <label>密碼  : </label><input type = "password" name = "password" class = "inputbox" /><?php echo "<c>".$passwordError."</c>"; ?><br>
            <label>密碼  : </label><input type = "password" name = "REpassword" class = "inputbox" /><br>
            <label>暱稱  : </label><input type = "text" name = "displayName" class = "inputbox"/><br style="margin:2px">
            <label>性別  : <select name="gender" class="select_gender">
               <option value="0">請選擇</option>
               <option value="1">女</option>
               <option value="2">男</option>
               <option value="3">不清楚</option>
            </select><br>
            <label>電郵  : </label><input type="text" name="email" class="inputbox"/><?php echo "<c>".$emailError."</c>"   ; ?>
            <br>
            <input class = "submit-button" name="submit" type = "submit" value = " Register "/><br />
         </form>
         
         <div style = "font-size:3vh;font-weight:bold; color:red; margin-top:10px"><?php echo $error; ?></div>
         
      </div>
      
   </div>
   
</div>
</body>
</html>