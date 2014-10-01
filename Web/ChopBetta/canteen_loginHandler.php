<?php
/**
 * Created by PhpStorm.
 * User: HP
 * Date: 10/1/2014
 * Time: 12:13 PM
 */
session_start();
require_once("canteen_class.php");
$controllerObj = new canteen_class();
$res=false;

$_SESSION['username']= null;
$_SESSION['cid']= null;
$_SESSION['vid']= null;

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){

    $res = $controllerObj->authenticate($_REQUEST['username'],$_REQUEST['password']);//this is echoing to ajax

    if($res){
        $_SESSION['username'] = $_REQUEST['username'];
        $_SESSION['cid'] = $res['cid'];
        $_SESSION['vid'] = $res['vendor_id'];
    }
  //  print_r($_SERVER['username']);
}
if(isset($_REQUEST['logout'])){
    session_destroy();
}

session_write_close();
print_r($controllerObj->str_error);
?>