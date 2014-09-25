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
                <a href="/">Kingston Coker</a>
                <ul class="dropdown">
                    <li class="active" ><button ng-click="loginfb()" >Logout</button></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>

<main class="centerPage">
    <section id="dataRows">
        <div class="row" id="addMealRow1">
            <label for="meals">Create menu</label>
            <div class="large-9 columns" style="padding-left: 0">

                    <select class="meals">

                    </select>

            </div>
            <div class="large-3 columns addBtn" style="padding-left: 0">
                 <button class="menuControl" onclick="addMealRow(this)" >Add to menu</button>
            </div>
        </div>
        <div id="adder"></div>

    </section>
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

        <div class="row">
            <div class="large-12 columns">
                <div class="row collapse">
                    <div class="small-10 columns">
                        <input id="foodItem_input" type="text" placeholder="Jollof, veg and chicken...">
                    </div>
                    <div class="small-2 columns">
                        <a href="#" class="button postfix" onclick="addMealdiff(this)">Save</a>
                    </div>
                </div>
            </div>
        </div>
        <a class="close-reveal-modal">&times;</a>
    </div>
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