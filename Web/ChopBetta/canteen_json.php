<?php
/**
 * Cafeteria CRUD
 */
	if (isset($_REQUEST['add_cafeteria'])){
		include_once("canteen_class.php");
		
		$cafeteria_name="";
		if (isset($_REQUEST["cafeteria_name"])) {
			$cafeteria_name=$_REQUEST["cafeteria_name"];
		}
		$c=new canteen_class();
		$c->add_cafeteria($cafeteria_name);
	}
	
	else if(isset($_REQUEST['display_cafeteria'])){
		include_once("canteen_class.php");
		
		$c=new canteen_class();
		$c->display_cafeteria();

		$array = array();	

		while($row = $c->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}

	else if (isset($_REQUEST['update_cafeteria'])){
		include_once("canteen_class.php");
		
		$cafeteria_name="";
		if (isset($_REQUEST["cafeteria_name"])) {
			$cafeteria_name=$_REQUEST["cafeteria_name"];
		}
		$c=new canteen_class();
		$c->update_cafeteria($cafeteria_name);

		$array = array();	

		while($row = $c->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}

	else if (isset($_REQUEST['delete_cafeteria'])){
		include_once("canteen_class.php");
		
		$cafeteria_id=0;
		if (isset($_REQUEST["cafeteria_id"])) {
			$cafeteria_id=$_REQUEST["cafeteria_id"];
		}
		$c=new canteen_class();
		$c->delete_cafeteria($cafeteria_id);

		$array = array();	

		while($row = $c->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);				
	}

/**
 * Vendor CRUD
 */

	else if (isset($_REQUEST['add_vendor'])){
		include_once("canteen_class.php");
		
		$vendor_name="";
		if (isset($_REQUEST["vendor_name"])) {
			$vendor_name=$_REQUEST["vendor_name"];
		}
		$vendor_password="";
		if (isset($_REQUEST["vendor_password"])) {
			$vendor_password=$_REQUEST["vendor_password"];
		}
		$v=new canteen_class();
		$v->add_vendor($vendor_name,$vendor_password,$cid);
	}

	else if (isset($_REQUEST['display_vendor'])){
		include_once("canteen_class.php");
		
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$v=new canteen_class();
		$v->display_vendor($cid);

		$array = array();	

		while($row = $v->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);	
	}

	else if (isset($_REQUEST['update_vendor'])){
		include_once("canteen_class.php");
		
		$vendor_name="";
		if (isset($_REQUEST["vendor_name"])) {
			$vendor_name=$_REQUEST["vendor_name"];
		}
		$vendor_password="";
		if (isset($_REQUEST["vendor_password"])) {
			$vendor_password=$_REQUEST["vendor_password"];
			$vendor_password=md5($vendor_password);
		}
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$v=new canteen_class();
		$v->update_vendor($vendor_name,$vendor_password,$cid);

		$array = array();	

		while($row = $v->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);	
	}

	else if (isset($_REQUEST['delete_vendor'])){
		include_once("canteen_class.php");
		
		$vendor_id=0;
		if (isset($_REQUEST["vendor_id"])) {
			$vendor_id=$_REQUEST["vendor_id"];
		}
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$v=new canteen_class();
		$v->delete_vendor($vendor_id,$cid);

		$array = array();	

		while($row = $v->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}
/**
 * Food list CRUD
 */
	if (isset($_REQUEST['add_foodList'])){
		include_once("canteen_class.php");
		
		$item_name="";
		if (isset($_REQUEST["item_name"]) && isset($_REQUEST["cid"])) {
			$item_name=$_REQUEST["item_name"];
            $cid=$_REQUEST["cid"];
		}
		$fl=new canteen_class();
		$fl->add_foodList($item_name,$cid);
	}
	
	else if(isset($_REQUEST['display_foodList'])){
		include_once("canteen_class.php");
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$fl=new canteen_class();
		$fl->display_foodList($cid);

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
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$fl=new canteen_class();
		$fl->update_foodList($item_name,$cid);

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}

	else if (isset($_REQUEST['delete_foodList'])){
		include_once("canteen_class.php");
		
		$item_id=0;
		if (isset($_REQUEST["item_id"])) {
			$item_id=$_REQUEST["item_id"];
		}
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$fl=new canteen_class();
		$fl->delete_foodList($item_id,$cid);

		$array = array();	

		while($row = $fl->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);				
	}
/**
 * Meal list CRUD
 */
    else if (isset($_REQUEST['add_mealList'])){
        include_once("canteen_class.php");

        $meal_name="";
        if (isset($_REQUEST["meal_name"]) && isset($_REQUEST["cid"])) {
            $meal_name=$_REQUEST["meal_name"];
            $cid=$_REQUEST["cid"];
        }
        $ml=new canteen_class();
        $ml->add_mealList($meal_name,$cid);
    }

    else if (isset($_REQUEST['display_mealList'])){
        include_once("canteen_class.php");

        $cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
        $ml=new canteen_class();
        $ml->display_mealList($cid);

        $array = array();

        while($row = $ml->fetch()){
            $array[] = array_map('utf8_encode',	$row);
        }
        echo json_encode($array);
    }

    else if (isset($_REQUEST['update_mealList'])){
        include_once("canteen_class.php");

        $meal_name="";
        if (isset($_REQUEST["meal_name"])) {
            $meal_name=$_REQUEST["meal_name"];
        }
        $cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
        $ml=new canteen_class();
        $ml->update_mealList($meal_name,$cid);

        $array = array();

        while($row = $ml->fetch()){
            $array[] = array_map('utf8_encode',	$row);
        }
        echo json_encode($array);
    }

    else if (isset($_REQUEST['delete_mealList'])){
        include_once("canteen_class.php");

        $meal_id=0;
        if (isset($_REQUEST["meal_id"])) {
            $meal_id=$_REQUEST["meal_id"];
        }
        $cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
        $ml=new canteen_class();
        $ml->delete_mealList($meal_id,$cid);

        $array = array();

        while($row = $ml->fetch()){
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
		$cm->add_currentMeal($current_meal_name,$cid);
	}

	else if (isset($_REQUEST['display_currentMeal'])){
		include_once("canteen_class.php");
		
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$cm=new canteen_class();
		$cm->display_currentMeal($cid);

		$array = array();	

		while($row = $cm->fetch()){
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
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$cm=new canteen_class();
		$cm->update_currentMeal($current_meal_name,$cid);

		$array = array();	

		while($row = $cm->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);	
	}

	else if (isset($_REQUEST['delete_currentMeal'])){
		include_once("canteen_class.php");
		
		$current_meal_id=0;
		if (isset($_REQUEST["current_meal_id"])) {
			$current_meal_id=$_REQUEST["current_meal_id"];
		}
		$cid=0;
		if (isset($_REQUEST["cid"])) {
			$cid=$_REQUEST["cid"];
		}
		$cm=new canteen_class();
		$cm->delete_currentMeal($current_meal_id,$cid);

		$array = array();	

		while($row = $cm->fetch()){
    	$array[] = array_map('utf8_encode',	$row);
		} 
		echo json_encode($array);		
	}
?>