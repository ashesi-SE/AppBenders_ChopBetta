<!doctype html>
<html>
<head>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
</head>
<body>
<nav class="top-bar" data-topbar role="navigation">
    <section class="top-bar-section">

        <ul class="left">
            <li><a href="#/view1">Home</a></li>
            <li><a href="#/view2">view2</a></li>
        </ul>
        <ul class="right">
            <li class="has-dropdown" ng-controller="fbLoginController">
                <a href="\">{{Loginstate}}</a>
                <ul class="dropdown">
                    <li class="active" ><button ng-click="loginfb()" >{{LogAction}}</button></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>

<main class="centerPage">
    <form>

        <div class="row">
            <label>Select Box</label>
            <div class="large-9 columns">

                    <select>
                        <option value="husker">Husker</option>
                        <option value="starbuck">Starbuck</option>
                        <option value="hotdog">Hot Dog</option>
                        <option value="apollo">Apollo</option>
                    </select>

            </div>
            <div class="large-3 columns">
                <span class="postfix"><button>Add to menu</button></span>
            </div>
        </div>

    </form>
</main>
</body>
<script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
<script src="assets/js/app.js" type="text/javascript"></script>
<script src="assets/js/foundation.min.js" type="text/javascript"></script>
<script>
    $(document).foundation();
</script>
</html>

<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 9/24/2014
 * Time: 12:56 AM
 */ 