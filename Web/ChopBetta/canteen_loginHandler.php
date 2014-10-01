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

if(isset($_REQUEST['username']) && isset($_REQUEST['password'])){
    $_SESSION['username']= null;
    $_SESSION['cid']= null;
    $_SESSION['vid']= null;
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
if(isset($_REQUEST['isAuthenticated'])){

    if($_SESSION['username']==null){
       echo false;
    }else{
       echo json_encode(array('stat' => 'VALID','dat' =>  Array ('vendor_id' => $_SESSION['vid'], 'vendor_name' => $_SESSION['username'],'cid' => $_SESSION['cid'] )));
    }
}

session_write_close();
print_r($controllerObj->str_error);
?>