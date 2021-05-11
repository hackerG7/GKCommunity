<?php
require "phpMailer/PHPMailerAutoload.php";
$mail = new PHPMailer;
$mail->Host="smtp.gmail.com";
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure="tls";

$mail->Username="gkgameplaycommunity@gmail.com";
$mail->Password="28727057";
$mail->setFrom("gkgameplaycommunity@gmail.com","GKGAMEPLAY");
$mail->addAddress("blackrc3638@gmail.com");
$mail->addReplyTo("gkgameplaycommunity@gmail.com");
$mail->isHTML(true);
$mail->Subject="PHP Mailer Subject";
$mail->Body="
<div style='background-color:black; color:white; font-size:30px;border:lime solid 5px;padding:15px;'>
    <h1 align=center>激活你的GK Community帳號</h1>
    <div style='background-color:rgb(0,0,0);padding:15px;border:white dashed 5px;'>
    <p>Dear 123 ,<br><br>Welcome to GK ━(*｀∀´*)ノ <br> go to this website to verify your email. <br><br> https://gkgameplay.tk/php/activate_email.php?randomCode=123 <br><br> Remember you should not share this url with other.
        <br>------------------------------------------<br>歡迎你加入GK哦━(*｀∀´*)ノ <br> 點擊這個網址來認證激活你的帳號 <br><br> https://gkgameplay.tk/php/activate_email.php?randomCode=123 <br><br> 請謹記不要隨意把這個網址分享給別人.
        <br><br>Yours truly,<br>GKGAMEPLAY</p>
    </div>
</div>
";
if(!$mail->send()){
    echo "message could not be sent";
}else{
    echo "message sent";
}/*
$sub= "fuck testing GK community";
$msg="welcome to GK Xosajodmasod; <br> www.gkgameplay.tk/php/activate_email.php?randomCode='123'";
$rec="blackrc3636@gmail.com";
mail($rec,$sub,$msg);*/
?>