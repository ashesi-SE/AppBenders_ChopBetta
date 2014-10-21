<?php
require_once 'Mobile_Detect.php';
$detect = new Mobile_Detect;
?>

<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ChopBetta | Today's Menu</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/vendor/modernizr.js"></script>
<!--    <link rel="stylesheet" href="css/index.css">-->
    <script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-55868008-1', 'auto');
  ga('send', 'pageview');

</script>
      <style>
          .card{
              background-color: #fbfbfb;
              border: 1px solid #AAA;
              border-bottom: 1px solid #888;
              /*border-radius: 3px;*/
              color: black;
              box-shadow: 0px 2px 2px #AAA;
              min-height: 60px;
              width:550px;
              font-size:25px;
              font-family: cursive;
              text-align: center;
              margin-bottom: 9px;
          }
          #tab_content{
              align-items: center;
              /*margin-left: 20%;*/
          }
      </style>
  </head>
  <body>
   
    <nav class="top-bar" data-topbar role="navigation">
  <ul class="title-area">

    <li class="name">
      <h1 align = "center" Font = "Calibri"><a href="#">Today's Menu</a></h1>
    </li>
     <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
    <li class="toggle-topbar"><a href="#"><div id="time"></div></a></li>
  </ul>

  <section class="top-bar-section">
    <!-- Right Nav Section -->
    <ul class="right">
      <li><a href="#"><div id="time1"></div></a></li>
      
    </ul>
  </section>
</nav>

<dl class="tabs" id="tabs" data-tab style="background-color: #6c6e8a;">
  
</dl>
<div class="tabs-content" id="tab_content">

<!--    <a href="#" data-reveal-id="create_meal_modal">Create new Cafeteria</a>-->
  
</div>

    <div id="create_modal" class="reveal-modal medium" data-reveal>
        <h2>Awesome.</h2>
        <p>Yaay android phone detected. Download our android app a better experience</p>
        <a href="../Android/index.php" class="button">Get the App</a>
        <a class="close-reveal-modal">&#215;</a>
    </div>


    <script src="js/vendor/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
        <script src="js/index.js"></script>
    <script>
      $(document).foundation();
    </script>
    <?php
    if ($detect->version('Android')) {
    // Your code here.
    echo 'help';
    echo "<script>$('#create_modal').foundation('reveal', 'open');</script>";
    }
    ?>
  </body>
</html>
