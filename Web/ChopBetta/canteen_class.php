<?php
/* 
contains the functions needed to create, retrieve, update and delete information in the database.
 */
include("canteen_database.php");
class canteen_class extends db{
    function canteen_class(){
        db::db();       
    }
//functions for the foodList table
    function add_foodList($item_name){ //this function allows those at the canteen to add food items to the database
        $strQuery="INSERT INTO foodList(`item_name`) 
            VALUES ('$item_name')"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function display_foodList(){ //this function shows the food items in the database
        $strQuery="SELECT `item_name` FROM foodList"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }
    
    function update_foodList($item_name){ //this function allows the food vendors to make changes to the food items
        $strQuery="UPDATE foodList SET `item_name`='$item_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function delete_foodList($item_name){ //allows the food vendors to delete food items from the database
        $strQuery="DELETE FROM foodList WHERE `item_name`='$item_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }


//functions for the mealList table
   function add_mealList($meal_name){ //this function allows food vendors to create meals out of food items
        $strQuery="INSERT INTO mealList(`meal_name`) 
            VALUES ('$meal_name')"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function display_mealList(){ //this functions displays the combinations of food items 
        $strQuery="SELECT `meal_name` FROM mealList"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }
    
    function update_mealList($meal_name){ //changes can be made to meal
        $strQuery="UPDATE mealList SET `meal_name`='$meal_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function delete_mealList($meal_name){ //a meal can be deleted from the database
        $strQuery="DELETE FROM mealList WHERE `meal_name`='$meal_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }


//functions for the currentMeal table
    function add_currentMeal($current_meal_name){ //allows food vendors add meals to the current list of 
    //food available at the canteens

        $strQuery="INSERT INTO currentMeal(`current_meal_name`) 
            VALUES ('$current_meal_name')"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function display_currentMeal(){ //displays the available meals and their 
    //ratings to customers

        $strQuery="SELECT `current_meal_name`,`customer_rating` FROM currentMeal"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }
    
    function update_currentMeal($current_meal_name){ //allows food vendors to make changes to the available meals
        $strQuery="UPDATE currentMeal SET `current_meal_name`='$current_meal_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }

    function delete_currentMeal($current_meal_name){ //allows food vendors to remove meals that are no longer 
    //available at the canteens

        $strQuery="DELETE FROM currentMeal WHERE `current_meal_name`='$current_meal_name'"; 

        if(!$this->sql_query($strQuery)){
            return false;
        }
        return true;
    }



}

?>
