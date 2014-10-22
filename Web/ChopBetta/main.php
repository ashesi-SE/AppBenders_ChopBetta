<?php
session_start();
if ($_SESSION['chopbetta']['username'] == null){
    header('Location: index.php');
}
?>
    <!doctype html>
    <html>
    <head>

        <title>ChopBetta</title>
        <link rel="stylesheet" href="assets/css/style.css"/>
        <link rel="stylesheet" href="assets/css/foundation.min.css"/>
        <link href="favicon.png" rel="icon">
        <script>
            (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
                (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
                m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
            })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

            ga('create', 'UA-55868008-1', 'auto');
            ga('send', 'pageview');

        </script>
    </head>
    <body>

    <nav class="top-bar fixed" data-topbar role="navigation">
        <section class="top-bar-section">

            <ul class="left">
                <li><a href="#">Home</a></li>
                <li><a href="#" data-reveal-id="create_meal_modal">Create meal item</a></li>
                <li><a href="#" data-reveal-id="add_foodItem_modal">Add food item</a></li>
                <li><a href="#" onclick="showMsg({msg:'to say or not to say'})">Popup tester</a></li>
            </ul>
            <ul class="right">
                <li class="has-dropdown">
                    <a href="/"><?php echo $_SESSION['chopbetta']['username']!= null? $_SESSION['chopbetta']['username'] : "Who r u?"; ?></a>
                    <ul class="dropdown">
                        <li class="active" ><a id="logout" >Logout</a></li>
                    </ul>
                </li>
            </ul>
        </section>
    </nav>
    <br><br><br>
    <main class="centerPage">
        <section id="currentMealsArea">
            <div class="row collapse prefix-round" id="addMealRow">

                <label for="meals">Select a meal to add to the current menu</label>
                <div class="large-9 columns" style="padding-left: 50">
                    <select class="meals">
                        <option value="load">Loading...</option>
                    </select>
                </div>

                <div class="large-3 columns addBtn" style="padding-left: 0">
                    <button class="menuControl button postfix" onclick="addCurMeal(this)">Add to menu</button>
                </div>
            </div>
            <section id="currentMealList" class="large-12 columns"  >
                <ul>
                    <li>Loading...</li>
                </ul>
            </section>

        </section>

    </main>


    <div id="create_meal_modal" class="reveal-modal medium" data-reveal>
        <div class="row">
            <div class="small-4 columns">
                <section id="selectableFoodList" class="large-12 columns"  >
                    <ul>
                        <li>Empty list...</li>
                    </ul>
                </section>
            </div>
            <div class="small-8 columns">
                <div class="small-9 columns">
                    <div class="displayArea">No food items selected</div>
                </div>
                <div class="small-3 columns">
                    <a href="#" onclick="add_toMealList()" class="button postfix">Add meal</a>
                </div>
                <section id="mealList" class="large-12 columns"  >
                    <ul>
                        <li>Empty list...</li>
                    </ul>
                </section>
            </div>
            <a class="close-reveal-modal">&times;</a>
        </div>
    </div>

    <div id="add_foodItem_modal" class="reveal-modal small" data-reveal>
        <div class="row">
            <div class="large-12 columns"> <!--TODO: Width can be altered for a better aesthetic appeal-->
                <div class="row collapse prefix-round">

                    <div class="small-10 columns">
                        <input id="foodItem" type="text" placeholder="Type food item here...eg: Plantain">
                    </div>
                    <div class="small-2 columns">
                        <a href="#" onclick="addFood()" class="button postfix">Add food</a>
                    </div>
                </div>
            </div>
            <section id="foodList" class="large-12 columns"  >
                <ul>
                    <li>Empty list...</li>
                </ul>
            </section>
            <a class="close-reveal-modal">&times;</a>
        </div>
    </div>
    <div id="picSlider"  >
        <ul class="back-orbit" data-orbit data-options="resume_on_mouseout: true;slide_number: false;">
            <li>
                <img src="assets/img/back%20(2).jpg" alt="slide 2" />
            </li>
            <li>
                <img src="assets/img/back%20(3).jpg" alt="slide 1" />
            </li>
            <li>
                <img src="assets/img/back%20(5).jpg" alt="slide 3" />
            </li>
            <li>
                <img src="assets/img/back%20(4).jpg" alt="slide 3" />
            </li>
        </ul>
    </div>

    </body>
    <script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
    <script src="assets/js/mapDS.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/js/foundation.min.js" type="text/javascript"></script>
    <script>
        $(document).foundation();
        $('.target').blurjs({
            source: 'body',			//Background to blur
            radius: 5,			//Blur Radius
            overlay: '',			//Overlay Color, follow CSS3's rgba() syntax
            offset: {			//Pixel offset of background-position
                x: 0,
                y: 0
            },
            optClass: '',			//Class to add to all affected elements
            cache: false,			//If set to true, blurred image will be cached and used in the future. If image is in cache already, it will be used.
            cacheKeyPrefix: 'blurjs-',	//Prefix to the keyname in the localStorage object
            draggable: false		//Only used if jQuery UI is present. Will change background-position to fixed
        });

    </script>
    </html>

<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 9/24/2014
 * Time: 12:56 AM
 */ 
