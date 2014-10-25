<?php
session_start();
if (@$_SESSION['chopbetta']['username'] != null){
    header('Location: main.php');
}
?>
<!doctype html>
<html>
<head>
    <title>ChopBetta</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
    <link href="favicon.png" rel="icon">
    <script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/js/foundation.min.js" type="text/javascript"></script>
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
            m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-55868008-1', 'auto');
        ga('send', 'pageview');

    </script>
</head>

<body class="login">
   <div class="logo">
       <img src="assets/img/logo.png">
       <div class="caption">ChopBetta</div>
   </div>

<section id="login">

    <div id="backblur"></div>
    <form class="centerPage" >
        <div>
            <div>
                <label for="username">Username</label>
                <input id="username" name="username" type="text" required="true" placeholder="Username">
            </div>
            <div>
                <label for="password">Password</label>
                <input id="password" name="password" type="password"
                       required="true" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">
            </div>

            <button type="submit" value="Log in">Log in</button>
            <label>
                <input id="isAdmin" type="checkbox" value="adminLogin"  />
                Login as admin
            </label>
        </div>
    </form>
</section>

</body>

</html>



