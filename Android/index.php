<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 10/16/2014
 * Time: 8:48 AM
 */ ?>
<html>
<head>

    <title>ChopBetta</title>
    <link rel="stylesheet" href="../Web/ChopBetta/assets/css/style.css"/>
    <link rel="stylesheet" href="../Web/ChopBetta/assets/css/foundation.min.css"/>
    <style>
        body{
            background: url(cb.jpg);
            background-size: cover;
        }
        body section{
            position: relative;
            height: 90%;
            text-align: center;
        }
        #download{
            position: absolute;
            top: 50%;
            -webkit-transform: translateX(-50%);
            margin-left: 100px;
            border: 2px solid #fff;
            background: transparent;
            font-family: Eurofurence, sans-serif;
            font-size: 45px;
            text-shadow: 0 0 3px #000;
            box-shadow: 0 0 3px #000;
        }
        #download:hover{
            background: rgba(255,255,255,0.2);
        }
        header{
            width: 100%;
            height: 10%;
            background: #f5f5f5;
            color: #ffffff;
        }
    </style>
</head>
<body >
<header>
    <div class="centerPage">
        ChopBetta
    </div>

</header>
<section class="centerPage">

    <button class="centerPage" id="download" onclick="location.href='ChopBetta.apk'">Download APK</button>
</section>
</body>
</html>