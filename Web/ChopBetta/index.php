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
            <li><a href="#/view2" data-reveal-id="today_menu_modal">Today's Menu</a></li>
            <li><a href="#/view2" data-reveal-id="create_meal_modal">Create meal item</a></li>
            <li><a href="#/view2" data-reveal-id="add_foodItem_modal">Add food item</a></li>
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

<div id="today_menu_modal" class="reveal-modal small" data-reveal>
    <div class="small-3 columns">
          <label for="right-label" class="right">Today's meal</label>
    </div>
        <div class="small-9 columns">
          <input type="text" id="right-label" placeholder="Inline Text Input">
        </div>
  <a class="close-reveal-modal">&#215;</a>
</div>

<div id="create_meal_modal" class="reveal-modal small" data-reveal>
    <div class="small-3 columns">
          <label for="right-label" class="right">Meal</label>
    </div>
        <div class="small-9 columns">
          <input type="text" id="right-label" placeholder="Inline Text Input">
        </div>
    <a class="close-reveal-modal">&#215;</a>
</div>

<div id="add_foodItem_modal" class="reveal-modal small" data-reveal>
    <div class="small-3 columns">
          <label for="right-label" class="right">Food item</label>
    </div>
        <div class="small-9 columns">
          <input type="text" id="right-label" placeholder="Inline Text Input">
        </div>
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