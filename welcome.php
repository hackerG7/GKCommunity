<?php
   include('public_session.php');
   
   mysqli_query($db,"SET NAMES 'utf8'"); 
   mysqli_query($db,"SET CHARACTER_SET_RESULTS=utf8");
   mysqli_query($db,"SET CHARACTER_SET_CLIENT=utf8"); 
   $result = mysqli_query($db,"SELECT id FROM articles");
   if (!$result) {
      printf("Error: %s\n", mysqli_error($db));
      exit();
   }
   $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);
?>
<html style="background-image:url('image_codeTile01.jpg');background-size:25%;font-family:monospace">
   <title>
      GK Community
   </title>
   <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
   <script>
      (adsbygoogle = window.adsbygoogle || []).push({
            google_ad_client: "ca-pub-1970277586541265",
            enable_page_level_ads: true
      });
   </script>
   <head>
   <link rel="stylesheet" type="text/css" href="styles.css">
   <link rel="stylesheet" type="text/css" href="general.css">
   <div class="topbar">
      <div class="topbar_home" style="display:flex">
         <a class="genre_button" href="welcome.php">
            home
         </a>
         </a><h1 style="font-size:80px;padding:0">主頁</h1>
      </div>   
      <div class="topbar_userdata">
      <?php
      if($_SESSION["login"]){
         echo "
         <h1>歡迎 ".
         get_displayName()."<c style='font-size:1vw'>  金幣: ".$_SESSION["userData"]["money"]."</c>

         </h1>  
         <a href = 'post_article.php' class='normal_button'>發文</a>
         <a href = 'my_post.php' class='normal_button'>我的文章</a>
         <a href = 'logout.php' class='normal_button'>登出</a>
         
        ";
      }else{
         echo "
         <h1>請先登入哦，親 
         <a href = 'login.php' class='normal_button'>登入</a>
         </h1>";
      }
      ?>
      </div>
   </div>
   </head>
   
   <body style="background-image:url('image_codeTile01.jpg');background-size:25%;font-family:monospace">
   
   <div class="content">

   <?php
      function add_priority_article($r){
         echo "<div class='articlebox' style='background-color:rgba(100,255,0,0.2); border-bottom:lime solid 5px'><a href='article.php?articleID=".$r["id"]."'>".$r["title"]."</a><author>by ".$r["author"]."</author>&nbsp&nbsp<date class='date'>".$r['date']."</date></div>";
      }
      function add_article($r){
         echo "<div class='articlebox'><a href='article.php?articleID=".$r["id"]."'>".$r["title"]."</a><author>by ".$r["author"]."</author>&nbsp&nbsp<date class='date'>".$r['date']."</date></div>";
      }
      if($count > 0 ){
         //PRIORITY
         $result = mysqli_query($db,"SELECT * FROM articles WHERE priority>0 ORDER BY priority DESC");
         if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
         }
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         $count = mysqli_num_rows($result);
         if($count>0){
            add_priority_article($row);
            while($row = mysqli_fetch_assoc($result)) {
               add_priority_article($row);
            }
         }
         //normal
         $result = mysqli_query($db,"SELECT * FROM articles WHERE priority=0 ORDER BY id DESC");
         if (!$result) {
            printf("Error: %s\n", mysqli_error($db));
            exit();
         }
         $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
         $count = mysqli_num_rows($result);
         if($count > 0){
            add_article($row);
            while($row = mysqli_fetch_assoc($result)) {
               add_article($row);
            }
         }
      }
   ?>
   </div>
   
   <div class="bottombar">
      gkgameplay.tk<br><br>
      Contact:blackrc3636@gmail.com<br><br>
      <a href="private_policy.html" style="color:white">private policy</a>
   </div>
   </body>
</html>