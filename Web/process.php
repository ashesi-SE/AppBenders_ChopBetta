<?php
$connect = mysql_connect("localhost", "root", ""); 

if (!$connect) 
{ die('Connection Failed: ' . mysql_error()); }

else
{ mysql_select_db("canteen", $connect);

}


//create new cafeteria
$cafe = "INSERT INTO cafeteria (cafeteria_name) VALUES ('".$_GET['cafeteria']."')";

//get Cid of new cafeteria 
$getCid = "SELECT cafeteria_id From cafeteria where cafeteria_name ='".$_GET['cafeteria']."'";


//create default vendor for the newly created cafeteria using its CID($getcid) to reference the cafeteria 
$vendor = "INSERT INTO vendors(vendor_name,vendor_password,cid) VALUES ('".$_GET['vendor']."','".md5( $_GET['v_password'])."', '".$getCid.") "; //fix the $getCid syntax error

echo $vendor;

if (!(mysql_query($cafe, $connect) && mysql_query($vendor, $connect))) 
{ 
	echo"Error: ".  mysql_error(); 
	
	echo "Your information was added to the database.";
	mysql_close($connect); 
}

?>