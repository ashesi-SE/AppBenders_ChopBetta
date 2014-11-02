<?php


// $database="canteen";
// $username="root";
// $password="";
// $server="localhost";
include("../../Web/ChopBetta/canteen_class.php");
// mysql_connect($server,$username,$password,$database);


class canteen_class_test extends PHPUnit_Framework_TestCase
{

    public function test_display_cafeteria()
    {
    	$c=new canteen_class();
        $this->assertEquals(true, $c->display_cafeteria());
    }
}
