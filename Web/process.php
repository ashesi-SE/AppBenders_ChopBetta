<?php
$connect = mysql_connect("localhost", "root", ""); 

if (!$connect) 
{ die('Connection Failed: ' . mysql_error()); }

else
{ mysql_select_db("canteen", $connect);

}


//create new cafeteria
$cafe = "INSERT INTO cafeteria (cafeteria_name) VALUES ('".$_GET['cafeteria']."')";
mysql_query($cafe, $connect);


//get Cid of new cafeteria 
$getCid = "SELECT cafeteria_id From cafeteria where cafeteria_name ='".$_GET['cafeteria']."'";
$result_cid = mysql_query($getCid, $connect);
$getCid = mysql_fetch_assoc($result_cid);

//create default vendor for the newly created cafeteria using its CID($getcid) to reference the cafeteria 
$vendor = "INSERT INTO vendors(vendor_name,vendor_password,cid) VALUES ('".$_GET['vendor']."','".md5( $_GET['v_password'])."', '".$getCid['cafeteria_id']."') "; //fix the $getCid syntax error

echo $vendor;

if (!mysql_query($vendor, $connect)) 
{ 
	echo"Error: ".  mysql_error(); 
	}

else{	
	echo "Your information was added to the database.";
	mysql_close($connect); 
}

?>