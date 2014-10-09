<!doctype html>
<html>
<head>
    <title>Super ADmin</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
    <script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <script src="assets/js/foundation.min.js" type="text/javascript"></script>
</head>

<body class="login">


<form id="login" class="centerPage" >
    <header>Login</header>
    <div>
        <label for="cafeteria">Enter Name of new Cafeteria </label>
        <input id="username" name="username" type="text" required="true" placeholder="Username">
	</div>

	<div>			
	<label for="vendor">Enter Vendor name </label>
        <input id="username" name="username" type="text" required="true" placeholder="Username">
	</div>
	<div>
	<label for="cafeteria">Enter vendor password </label>
        <input id="password" name="password" type="password"
               required="true" placeholder="&#8226;&#8226;&#8226;&#8226;&#8226;&#8226;">

    </div>
   
    <button type="submit" value="Log in">Log in</button>
</form>

<div id='result'>

</div>
</body>

</html>