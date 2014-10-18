<?php

//TODO: make the trues echo 1 and the false echo mysql_error
/* 
contains the functions needed to create, retrieve, update and delete information in the database.
 */
include("canteen_database.php");
class canteen_class extends db{
    function canteen_class(){
        db::db();
    }

//functions for the cafeteria table
    function add_cafeteria($cafeteria_name){ //this function allows a super admin to add new cafeteria to the database
        $strQuery="INSERT INTO cafeteria(`cafeteria_name`) 
            VALUES ('$cafeteria_name')";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function display_cafeteria(){ //this function shows all cafeterias on campus
        $strQuery="SELECT `cafeteria_id`,`cafeteria_name` FROM cafeteria";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        return 1;
    }

    function get_cafeteria_id($cafeteria_name)
    {
        $strQuery = "SELECT `cafeteria_id` FROM `cafeteria` WHERE `cafeteria_name` ='$cafeteria_name'";
        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
//        echo "1";
        return true;
    }

    function update_cafeteria($cafeteria_id, $cafeteria_name)
    { //allows the super admin to make changes to the cafeterias
        $strQuery = "UPDATE cafeteria SET `cafeteria_name`='$cafeteria_name' WHERE `cafeteria_id`='$cafeteria_id'";
        echo $strQuery;
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
        return true;
    }

    function delete_cafeteria($cafeteria_id)
    { //allows the super admin to delete cafeterias from the database
        $strQuery = "DELETE FROM `currentmeal` WHERE cid=$cafeteria_id;";
        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        $strQuery = "DELETE FROM `meallist` WHERE cid=$cafeteria_id";
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
        $strQuery = "DELETE FROM `foodlist` WHERE cid=$cafeteria_id; ";
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
        $strQuery = "DELETE FROM `vendors` WHERE cid=$cafeteria_id; ";
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
        $strQuery = " DELETE FROM `cafeteria` WHERE cafeteria_id=$cafeteria_id; ";
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

//functions for the vendors table
    function add_vendor($vendor_name,$vendor_password,$cid){ //adds vendors to a specific canteen
        $strQuery="INSERT INTO vendors(`vendor_name`,`vendor_password`,`cid`) 
            VALUES ('$vendor_name',md5('$vendor_password'),$cid)";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function display_vendor($cid){ //this function pulls the vendors in each cafeteria, in the database
        $strQuery = "SELECT `vendor_name`,`vendor_id` FROM vendors WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        return 1;
    }


    function update_vendor_non_password($vendor_name, $cid)
    {
        $strQuery = "UPDATE vendors SET `vendor_name`='$vendor_name' WHERE `cid`=$cid";
        echo $strQuery;
        if (!$this->sql_query($strQuery)) {
            mysql_error();
            return false;
        }
//        echo "1";
        return true;
    }


    function update_vendor($vendor_name,$vendor_password,$cid){ //can change the details of food vendors 
        $strQuery="UPDATE vendors SET `vendor_name`='$vendor_name',`vendor_password`='$vendor_password' 
        WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function delete_vendor($vendor_id,$cid){ //can delete food vendors from the database
        $strQuery="DELETE FROM vendors WHERE `vendor_id`=$vendor_id AND `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

//functions for the foodList table
    function add_foodList($item_name,$cid){ //this function allows those at the canteen to add food items to the database
        $strQuery="INSERT INTO foodList(`item_name`,`cid`) 
            VALUES ('$item_name',$cid)";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function display_foodList($cid){ //this function shows the food items in the database
        $strQuery="SELECT `item_id`,`item_name` FROM foodList WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        return 1;
    }

    function update_foodList($item_name,$cid){ //this function allows the food vendors to make changes to the food items
        $strQuery="UPDATE foodList SET `item_name`='$item_name' WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function delete_foodList($item_id,$cid){ //allows the food vendors to delete food items from the database
        $strQuery="DELETE FROM foodList WHERE `item_id`=$item_id AND `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }


//functions for the mealList table
    function add_mealList($meal_name,$cid){ //this function allows food vendors to create meals out of food items
        $strQuery="INSERT INTO mealList(`meal_name`,`cid`) 
            VALUES ('$meal_name',$cid)";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function display_mealList($cid){ //this functions displays the combinations of food items 
        $strQuery="SELECT `meal_id`,`meal_name` FROM mealList WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        return 1;
    }

    function update_mealList($meal_name,$cid){ //changes can be made to meal
        $strQuery="UPDATE mealList SET `meal_name`='$meal_name' WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function delete_mealList($meal_id,$cid){ //a meal can be deleted from the database
        $strQuery="DELETE FROM mealList WHERE `meal_id`=$meal_id AND `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }


    /**
     * functions for the currentMeal table
     * */
    function add_currentMeal($current_meal_id,$current_meal_name,$cid){ //allows food vendors add meals to the current list of 
        //food available at the canteens

        $strQuery="INSERT INTO currentMeal(`current_meal_id`,`current_meal_name`,`cid`) 
            VALUES ('$current_meal_id','$current_meal_name',$cid)";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function display_currentMeal($cid){ //displays the available meals and their 
        //ratings to customers

        $strQuery="SELECT `current_meal_id`,`current_meal_name`,`customer_rating`,`number_of_ratings`,`cid` FROM currentMeal WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        return 1;
    }

    function update_currentMeal($current_meal_name,$cid){ //allows food vendors to make changes to the available meals
        $strQuery="UPDATE currentMeal SET `current_meal_name`='$current_meal_name' WHERE `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            mysql_error();
            return false;
        }
        echo "1";
        return true;
    }

    function delete_currentMeal($current_meal_id,$cid){ //allows food vendors to remove meals that are no longer
        //available at the canteens

        $strQuery="DELETE FROM currentMeal WHERE `current_meal_id`=$current_meal_id AND `cid`=$cid";

        if(!$this->sql_query($strQuery)){
            echo $this->str_error;
            return false;
        }
        echo "1";
        return true;
    }

    function authenticate($username, $password){
        if ($username == "superAdmin")
            $strQuery = "SELECT * FROM superAdmin WHERE `vendor_name`='$username'";
        else
            $strQuery="SELECT * FROM vendors WHERE `vendor_name`='$username'";
        $this->sql_query($strQuery);
        $row = $this->fetch();
        if(!$row){
            echo json_encode(array('stat' => 'NOU'));//No user found
            return false;
        }else{
            $password = md5($password);
            if($password == $row['vendor_password']){
                echo json_encode(array('stat' => 'VALID','dat' => $row));//valid user and password
                return $row;
            }else{
                echo json_encode(array('stat' => 'BADPASS'));//valid user invalid password
                return false;
            }
        }

    }

    function ratings($customer_rating,$current_meal_id){ //shows the ratings assigned to each meal
        $strQuery="SELECT `customer_rating`,`number_of_ratings` FROM currentMeal WHERE
        `current_meal_id`=$current_meal_id";

        if(!$this->sql_query($strQuery)){
            mysql_error();
        }
        else{
            $row=$this->fetch();

            $new_rating=($row['customer_rating']*$row['number_of_ratings']+$customer_rating)/(++$row['number_of_ratings']);

            $strQuery="UPDATE currentMeal SET `customer_rating`=".$new_rating." , `number_of_ratings`=".($row['number_of_ratings']) .
                " WHERE `current_meal_id`=$current_meal_id";
            if(!$this->sql_query($strQuery)){
                mysql_error();
                return false;
            }else{
                echo 1;
            }
        }
        return true;
    }
}

?>
