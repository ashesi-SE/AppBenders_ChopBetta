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

if(isset($_REQUEST['username']) && isset($_REQUEST['password']) && isset($_REQUEST['isAdmin'])){
    ($_REQUEST['isAdmin'])?$_SESSION['chopbetta']['superuser']= null:$_SESSION['chopbetta']['username']= null;
    $_SESSION['chopbetta']['cid']= null;
    $_SESSION['chopbetta']['vid']= null;
    $res = $controllerObj->authenticate($_REQUEST['username'],$_REQUEST['password']);//this is echoing to ajax

    if($res){
        ($_REQUEST['isAdmin'])?$_SESSION['chopbetta']['superuser']= $_REQUEST['username']:
            $_SESSION['chopbetta']['username']= $_REQUEST['username'];
        $_SESSION['chopbetta']['cid'] = $res['cid'];
        $_SESSION['chopbetta']['vid'] = $res['vendor_id'];
    }
    //  print_r($_SERVER['username']);
}
if(isset($_REQUEST['logout'])){
    session_destroy();
}
if(isset($_REQUEST['isAuthenticated'])){

    if($_SESSION['chopbetta']['username']==null){
        echo false;
    }else{
        echo json_encode(array('stat' => 'VALID','dat' =>  Array ('vendor_id' => $_SESSION['chopbetta']['vid'], 'vendor_name' => $_SESSION['chopbetta']['username'],'cid' => $_SESSION['chopbetta']['cid'] )));
    }
}

session_write_close();
print_r($controllerObj->str_error);
?>