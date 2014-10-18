<?php
session_start();
if ($_SESSION['chopbetta']['superuser'] == null) {
    header('Location: index.php');
}
?>
<!doctype html>
<html>
<head>

    <title>ChopBetta</title>
    <link rel="stylesheet" href="assets/css/style.css"/>
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
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

<nav class="top-bar" data-topbar role="navigation">
    <section class="top-bar-section">

        <ul class="left">
            <li><a href="#">Home</a></li>
            <li><a href="#" data-reveal-id="create_meal_modal" onclick="createNewCafeteria()">Create new Cafeteria</a>
            </li>
        </ul>
        <ul class="right">
            <li class="has-dropdown">
                <a href="#">Super Admin</a>
                <ul class="dropdown">
                    <li><a href="#" id="logout">Logout</a></li>
                </ul>
            </li>
        </ul>
    </section>
</nav>

<main class="centerPage">

    <table class="centerPage">
    <thead>
        <tr>
            <th>Cafeteria name</th>
            <th>Edit</th>
            <th width="150">Delete</th>
        </tr>
        </thead>
        <tbody id="table_content"></tbody>
    </table>

    <div id="create_meal_modal" class="reveal-modal medium" data-reveal>
        <div id="cafeteria_name_box">
            <label>Name of new Cafeteria</label>

            <div class="large-9 columns" style="padding-left: 50">
                <input type="text" id="cafeteria_name">
            </div>

            <div class="large-3 columns" style="padding-left: 0">
                <button class="menuControl button postfix" onclick="addCafeteria(1)">Add cafeteria</button>
            </div>
        </div>
        <div id="cafeteria_vendor_box">
            <form>
                <fieldset>
                    <legend>Vendor information</legend>

                    <label>Vendor name
                        <input type="text" id="vendor_name" placeholder="this would be the username for logging in">
                    </label>
                    <label>Password
                        <input type="password" id="vendor_password" placeholder="Password">
                    </label>
                    <a class="button right" onclick="addCafeteria(2)">Create Vendor</a>
                </fieldset>
            </form>
        </div>
    </div>

    <div id="edit_cafeteria_modal" class="reveal-modal medium" data-reveal>
        <form>
            <fieldset>
                <legend>Cafeteria information</legend>
                <label>Cafeteria name
                    <input type="text" id="edit_cafeteria_name" placeholder="Cafeteria name here">
                </label>
            </fieldset>
        </form>
        <form>
            <fieldset>
                <legend>Vendor information</legend>
                <label>Vendor name
                    <input type="text" id="edit_vendor_name" placeholder="vendor name here">
                </label>
                <input id="edit_vendor_id" type="hidden">
                <input id="edit_cafeteria_id" type="hidden">
                <input id="checkbox2" type="checkbox">
                <label for="checkbox2">Change password</label>
                <label>Reset password
                    <input type="password" id="edit_password" placeholder="Reset password"/>
                </label>
                <a class="button right" onclick="saveEditCafeteria()">Save Changes</a>
            </fieldset>
        </form>
    </div>

</main>

</body>
<script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
<script src="assets/js/mapDS.js" type="text/javascript"></script>
<script src="assets/js/super_user.js" type="text/javascript"></script>
<script src="assets/js/app.js" type="text/javascript"></script>
<script src="assets/js/foundation.min.js" type="text/javascript"></script>
<script>
    $(document).foundation();
</script>
</html>
