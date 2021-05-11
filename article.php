<?php
   include('public_session.php');
   $a = mysqli_real_escape_string($db,$_GET["articleID"]);
   $sql = "SELECT * FROM articles WHERE id = ".$a;
   $result = mysqli_query($db,$sql);
   if (!$result) {
      printf("Error: %s\n", mysqli_error($db));
      exit();
   }
   $rows = mysqli_fetch_array($result,MYSQLI_ASSOC);
   $count = mysqli_num_rows($result);
   
?>
<html style="background-image:url('image_codeTile01.jpg');background-size:25%;font-family:monospace">
   
   <head>
   <link rel="stylesheet" type="text/css" href="styles.css">
   <link rel="stylesheet" type="text/css" href="general.css">

   <script>
      (adsbygoogle = window.adsbygoogle || []).push({
         google_ad_client: "ca-pub-1970277586541265",
         enable_page_level_ads: true
      });
   </script>
   <title>GK Community </title>
   </head>
   <body style="background-image:url('image_codeTile01.jpg');background-size:25%;font-family:monospace">
   <div class="topbar" style="border:lime dashed 5px;border-bottom:none">
      <div class="topbar_home" style="display:flex">
         <a class="genre_button" href="welcome.php">
            home
         </a>
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
   </div>
   
   <div class="content" style="border:lime dashed 5px">
      <div name="article" style="overflow:hidden;width:100%;display:flex;">
         <div class='userBox'>
            <?php
               if($count > 0 ){
                  echo $rows["author"];            
               }
            ?>
         </div>
         <div class="innerContent">
            <div class="innerTitle">
               <?php
                  if($count > 0 ){
                     echo $rows["title"];            
                  }
               ?>
            </div>
            <div class="innerRealContent" >
               <?php
                  if($count > 0 ){
                     if(!$rows["isHTML"]){
                        echo str_replace(" ","&nbsp",str_replace("\n","<br>",$rows["content"])); 
                     }else{
                        echo $rows["content"];
                     }           
                  }  
               ?>
            </div>
         </div>
            
      </div>
      
   </div>
   </body>
   
</html>
