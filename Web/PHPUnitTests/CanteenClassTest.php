<?php

include("../ChopBetta/canteen_class.php");


class CanteenClassTest extends \PHPUnit_Framework_TestCase
{
     
    //cafeteria tests
	public function test_add_cafeteria()
    {	
        $c=new canteen_class();
        $this->assertEquals(true, $c->add_cafeteria('NewCafeteria')); //supposed to add cafeteria to database
    }
    public function test_display_cafeteria()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->display_cafeteria()); //supposed to display cafeterias 
    }
    public function test_get_cafeteria_id()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->get_cafeteria_id('NewCafeteria')); //supposed to get cafeteria ID based on cafeteria name
    }
    public function test_update_cafeteria()
    {
        $c=new canteen_class();
        $c->get_cafeteria_id('NewCafeteria');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_cafeteria($row['cafeteria_id'], 'Cafe'));  
    } 
    public function test_delete_cafeteria()
    {
        $c=new canteen_class();
        $c->get_cafeteria_id('Cafe');
        $row=$c->fetch();
        $this->assertEquals(true, $c->delete_cafeteria($row['cafeteria_id']));  
    }

    //vendor tests
    public function test_add_vendor()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->add_vendor('Phineas','run',2));  
    } 
    public function test_display_vendor()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->display_vendor(2));  
    } 
    public function test_get_vendor_id()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->get_vendor_id('Phineas')); //supposed to get cafeteria ID based on cafeteria name
    }
    public function test_update_vendor_non_password()
    {
        $c=new canteen_class();
        $c->get_vendor_id('Phineas');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_vendor_non_password('TT', $row['vendor_id']));  
    } 
    public function test_update_vendor()
    {
        $c=new canteen_class();
        $c->get_vendor_id('TT');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_vendor('Una','shs',$row['vendor_id']));  
    } 
    public function test_delete_vendor()
    {
        $c=new canteen_class();
        $c->get_vendor_id('Una');
        $row=$c->fetch();
        $this->assertEquals(true, $c->delete_vendor($row['vendor_id'],2));  
    }

    //foodList tests
    public function test_add_foodList()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->add_foodList('Taco chips',2));  
    } 
    public function test_display_foodList()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->display_foodList(2));  
    } 
    public function test_get_foodList_id()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->get_foodList_id('Taco chips')); //supposed to get cafeteria ID based on cafeteria name
    }
    public function test_update_foodList()
    {
        $c=new canteen_class();
        $c->get_foodList_id('Taco chips');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_foodList('Baked Tacos',$row['item_id']));  
    }
    public function test_delete_foodList()
    {
        $c=new canteen_class();
        $c->get_foodList_id('Baked Tacos');
        $row=$c->fetch();
        $this->assertEquals(true, $c->delete_foodList($row['item_id'],2)); 
    } 

    //mealList tests 
    public function test_add_meal()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->add_mealList('Lasagna and garlic bread',2));
        $mid = $c->get_id(); 

        $this->assertEquals(true, $c->add_currentMeal($mid,'Chinese noodles and lobster sauce',2));   
    }
    public function test_display_mealList()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->display_mealList(2));  
    }
    public function test_get_mealList_id()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->get_mealList_id('Lasagna and garlic bread')); //supposed to get cafeteria ID based on cafeteria name
    }   
    public function test_update_mealList()
    {
        $c=new canteen_class();
        $c->get_mealList_id('Lasagna and garlic bread');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_mealList('Ghanasagna and garlic bread',$row['meal_id']));  
    }

    

    //currentMeal tests
    public function test_display_currentMeal()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->display_currentMeal(2));  
    }
    public function test_get_currentMeal_id()
    {
        $c=new canteen_class();
        $this->assertEquals(true, $c->get_currentMeal_id('Chinese noodles and lobster sauce')); //supposed to get cafeteria ID based on cafeteria name
    }    
    public function test_update_currentMeal()
    {
        $c=new canteen_class();
        $c->get_currentMeal_id('Chinese noodles and lobster sauce');
        $row=$c->fetch();
        $this->assertEquals(true, $c->update_currentMeal('Jamaican noodles and lobster sauce',$row['current_meal_id']));  
    }
    public function test_ratings()
    {
        $c=new canteen_class();
        $c->get_currentMeal_id('Jamaican noodles and lobster sauce');
        $row=$c->fetch();
        $this->assertEquals(true, $c->ratings(3,$row['current_meal_id']));  
    } 
    public function test_delete_currentMeal()
    {
        $c=new canteen_class();
        $c->get_currentMeal_id('Jamaican noodles and lobster sauce');
        $row=$c->fetch();
        $this->assertEquals(true, $c->delete_currentMeal($row['current_meal_id'],2));  
    } 
    public function test_delete_mealList()
    {
        $c=new canteen_class();
        $c->get_mealList_id('Ghanasagna and garlic bread');
        $row=$c->fetch();
        $this->assertEquals(true, $c->delete_mealList($row['meal_id'],2));  
    }
    public function test_authenticate()
    {
        $c=new canteen_class();
        $this->assertEquals(1, $c->authenticate('superAdmin',12345)["vendor_id"]);  
    } 
}
?>