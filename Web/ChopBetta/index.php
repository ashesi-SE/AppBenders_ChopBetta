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
            <li class="has-dropdown">
                <a href="\">{{Loginstate}}</a>
                <ul class="dropdown">
                    <li class="active" ><button ng-click="loginfb()" >{{LogAction}}</button></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>

<main class="centerPage">
    <section>
<a href="#" data-reveal-id="myModal">Click Me For A Modal</a>

<div id="myModal" class="reveal-modal" data-reveal>
  <h2>Awesome. I have it.</h2>
  <p class="lead">Your couch.  It is mine.</p>
  <p>I'm a cool paragraph that lives inside of an even cooler modal. Wins!</p>
  <a class="close-reveal-modal">&#215;</a>
</div>
        <div class="row" id="addMealRow1">
            <label for="meals">Create menu</label>
            <div class="large-9 columns" style="padding-left: 0">

                    <select class="meals">
                        <option value="husker">Husker</option>
                        <option value="starbuck">Starbuck</option>
                        <option value="hotdog">Hot Dog</option>
                        <option value="apollo">Apollo</option>
                    </select>

            </div>
            <div class="large-3 columns addBtn" style="padding-left: 0">
                 <button class="menuControl" >Add to menu</button>
            </div>
        </div>
        <div id="adder"></div>

    </section>
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