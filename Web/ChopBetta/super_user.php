<!doctype html>
<html>
<head>
    <title>Super ADMIN</title>
    <link href="assets/css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/foundation.min.css"/>
    <script src="assets/js/jquery-1.11.0.js" type="text/javascript"></script>
    <script src="assets/js/app.js" type="text/javascript"></script>
    <style>
        #displayCafe table{
            margin: 0 auto;
        }
        #displayCafe tr span{
            float: right;
            padding: 4px;
        }
    </style>
    
</head>

<body class="login">



<div id="createCafe" class="reveal-modal" style="z-index:500" data-reveal>
  <form id="login" class="centerPage" action="process.php" method="GET">
    
        <div>
        <label for="cafeteria">Name of Cafeteria</label>
        <input type="text" name="cafeteria" placeholder="Cafeteria">
        </div>
        <div>
        <label for="vendor">Name of Vendor</label>
        <input type="text" name="vendor" placeholder="Vendor name">
        </div>
        <div>
        <label for="v_password">Vendor Password</label>
        <input type="password" name="v_password" placeholder="Password">
        </div>
        <button type="submit" value="Log in">CREATE</button>

</form>
<a class="close-reveal-modal">&#215;</a> 
</div>


<div id="displayCafe" class="reveal-modal small" style="z-index:500" data-reveal>
  
<?php
include ("canteen_class.php");
$c = new canteen_class;
$c->display_cafeteria();  
?>
<table>
  <thead>
    <tr>
      <th>List of Canteens</th>
    </tr>
  </thead>
    <?php
    $row=$c->fetch();
    while($row){
        echo "<tr>";
        echo "<td>".$row['cafeteria_name']."<span class='icon-edit'></span><span class='icon-delete'></span></td>";
        echo "</tr>";
        $row=$c->fetch();
    }
    ?>
</table>

<a class="close-reveal-modal">&#215;</a> 
</div>

<div id='result'></div>



<button href="#" data-reveal-id="createCafe">Create cafetreia</button>
<button href="#" data-reveal-id="displayCafe">Show cafeteria</button>


<script src="assets/js/foundation.min.js" type="text/javascript"></script>
<script type="text/javascript">
     $(document).foundation();
</script>

</body>

</html>