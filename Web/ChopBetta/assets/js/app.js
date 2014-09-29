/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var meals = "";
var mealInputRow = "";
$(document).ready(function(){
    //gets food available
    $.get('canteen_json.php',{display_MealList: 2},function(data,status){
        console.log(data);
        $.each(data,function(key, elem  ){
            var meal = $.parseJSON(elem.meal_name); var mealStr = "";
            for (var i=0;i<meal.length;i++){
                if(i < meal.length-1){
                    mealStr += meal[i]+", ";
                }else{
                    mealStr += " and "+ meal[i];
                }
            }
            meals+='<option value="'+elem.meal_name+'">'+mealStr+'</option>'
        });
        $('#addMealRow1').find('.meals').html(meals);
    },"json");

});


function setupRow(foods){
    mealRows++;
    mealInputRow = ' <div class="row" id="addMealRow'+mealRows+'">'+

    '<div class="large-9 columns" style="padding-left: 0">'+
    '<select id="meals">'+
    foods +
    '</select>'+
    '</div>'+
    '<div class="large-3 columns addBtn" style="padding-left: 0">'+
    '<button onclick="addMealRow(this)">Add to menu</button>'+
    '</div>'+
    '</div>';

    return mealInputRow;
}

//TODO: Consider using one add to menu button, like Shamir suggested.
function addMealRow(elem){
    var parent = elem.parentNode.parentNode;

    $.get('canteen_json.php',{add_currentMeal:1,current_meal_name: $('#'+parent.id).find('.meals').val()},function(data,status){
        //do the below on successful add to db
        elem.className += " alert";
        elem.innerHTML = 'Remove';

        $('#dataRows').append(setupRow(meals));
        elem.setAttribute('onclick', 'remMealRow(this)');
    });
}
function remMealRow(elem){

    var parent = elem.parentNode.parentNode;
    console.log(parent.id);
    $('#'+parent.id).remove();
}
function addMealdiff(elem){
    $.get('canteen_json.php',{add_foodList:1,item_name: $('#foodItem_input').val()},function(data,status){
        $('#add_foodItem_modal').foundation('reveal', 'close');
    });
}
function showMsg(type,msg,options){
    var options = $.extend({type : "info", speed : 40, mousestop : true }, options);

}



