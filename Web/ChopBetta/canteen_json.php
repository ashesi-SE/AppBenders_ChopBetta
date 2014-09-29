<?php
/**
 * FoodList CRUD
 */
	if (isset($_REQUEST['add_foodList'])){
		include_once("canteen_class.php");
		
		$item_name="";
		if (isset($_REQUEST["item_name"])) {
			$item_name=$_REQUEST["item_name"];
		}
		$fl=new canteen_class();
		$fl->add_foodList($item_name);
	}
	
	else if(isset($_REQUEST['display_foodList'])){
		include_once("canteen_class.php");
		
		$fl=new canteen_class();
		$fl->display_foodList();

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}

	else if (isset($_REQUEST['update_foodList'])){
		include_once("canteen_class.php");
		
		$item_name="";
		if (isset($_REQUEST["item_name"])) {
			$item_name=$_REQUEST["item_name"];
		}
		$fl=new canteen_class();
		$fl->update_foodList($item_name);

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}

	else if (isset($_REQUEST['delete_foodList'])){
		include_once("canteen_class.php");
		
		$item_name="";
		if (isset($_REQUEST["item_name"])) {
			$item_name=$_REQUEST["item_name"];
		}
		$fl=new canteen_class();
		$fl->delete_foodList($item_name);

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);				
	}
/**
 * Current meal OR MENU CRUD
 */

	else if (isset($_REQUEST['add_currentMeal'])){
		include_once("canteen_class.php");
		
		$current_meal_name="";
		if (isset($_REQUEST["current_meal_name"])) {
			$current_meal_name=$_REQUEST["current_meal_name"];
		}
		$cm=new canteen_class();
		$cm->add_currentMeal($current_meal_name);
	}

	else if (isset($_REQUEST['display_currentMeal'])){
		include_once("canteen_class.php");
		
		$cm=new canteen_class();
		$cm->display_currentMeal();

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);	
	}

	else if (isset($_REQUEST['update_currentMeal'])){
		include_once("canteen_class.php");
		
		$current_meal_name="";
		if (isset($_REQUEST["current_meal_name"])) {
			$current_meal_name=$_REQUEST["current_meal_name"];
		}
		$cm=new canteen_class();
		$cm->update_currentMeal($current_meal_name);

		$array = array();	

		while($row = $cm->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);	
	}

	else if (isset($_REQUEST['delete_currentMeal'])){
		include_once("canteen_class.php");
		
		$current_meal_name="";
		if (isset($_REQUEST["current_meal_name"])) {
			$current_meal_name=$_REQUEST["current_meal_name"];
		}
		$cm=new canteen_class();
		$cm->delete_currentMeal($current_meal_name);

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}
    /**
     * Meal list CRUD
     */
    else if (isset($_REQUEST['add_MealList'])){
        include_once("canteen_class.php");

        $meal_name="";
        if (isset($_REQUEST["mealName"])) {
            $meal_name=$_REQUEST["mealName"];
        }
        $cm=new canteen_class();
        $cm->add_mealList($meal_name);
    }

    else if (isset($_REQUEST['display_MealList'])){
        include_once("canteen_class.php");

        $cm=new canteen_class();
        $cm->display_mealList();

        $array = array();

        while($row = $cm->fetch()){
            $array[] = array_map('utf8_encode',	$row);
        }
        echo json_encode($array);
    }

    else if (isset($_REQUEST['update_currentMeal'])){
        include_once("canteen_class.php");

        $meal_name="";
        if (isset($_REQUEST["meal_name"])) {
            $current_meal_name=$_REQUEST["meal_name"];
        }
        $cm=new canteen_class();
        $cm->update_currentMeal($meal_name);

        $array = array();

        while($row = $fl->fetch()){
            $array[] = array_map('utf8_encode',	$row);
        }
        echo json_encode($array);
    }

    else if (isset($_REQUEST['delete_Meal'])){
        include_once("canteen_class.php");

        $meal_name="";
        if (isset($_REQUEST["meal_name"])) {
            $meal_name=$_REQUEST["meal_name"];
        }
        $cm=new canteen_class();
        $cm->delete_currentMeal($meal_name);

        $array = array();

        while($row = $fl->fetch()){
            $array[] = array_map('utf8_encode',	$row);
        }
        echo json_encode($array);
    }
?>