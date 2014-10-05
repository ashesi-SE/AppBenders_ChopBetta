<?php


// $database="canteen";
// $username="root";
// $password="";
// $server="localhost";
include("./ChopBetta/canteen_class.php");
// mysql_connect($server,$username,$password,$database);


class CanteenClassTest extends \PHPUnit_Framework_TestCase
{

    public function test_display_cafeteria()
    {
    	$c=new canteen_class();
        $this->assertEquals(true, $c->display_cafeteria());
    }
}
?>