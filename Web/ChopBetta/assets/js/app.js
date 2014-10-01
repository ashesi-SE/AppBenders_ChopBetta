/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var mealsAvailable = "";
var userData = "";//Values are set by login handlers
$(document).ready(function(){
    /**
     * Login n logout handlers
     */
    $.get('canteen_loginHandler.php',{isAuthenticated:2},function(data){

        if(data){
            userData = data.dat;
            mealsAvailable = generateMealList();
            $('#addMealRow1').find('.meals').html(mealsAvailable);
            console.log(userData);
        }

    },"json");

    $('#login').submit(function(e){
        e.preventDefault();
        $.get('canteen_loginHandler.php',{username: $('#username').val(),
                password: $('#password').val()},function(data) {
            if (data.stat == "VALID") {
                userData = data.dat;
                console.log(userData);
                window.location.href = "main.php";
            }
        },"json");
    });

    $('#logout').click(function(){
        $.get('canteen_loginHandler.php',{logout: "x"}).done(function(){
            window.location.href = "index.php";
        });
    });
});

/**
 * Creates meal list for a specified canteen
 * <option>{meal here}</option> part
 */
function generateMealList(){
    console.log("CID: "+userData.cid);
    var meals = "";
    $.get('canteen_json.php',{display_MealList: 2,cid:userData.cid},function(data){
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
            meals+='<option value="'+mealStr+'">'+mealStr+'</option>'
        });
    },"json");

    return meals;
}


function addMeal(elem){
   var newMealDOM = ' <div class="row" id="addMealRow'+mealRows+'">'+
    '<div class="large-9 columns" style="padding-left: 0">'+
    '<select id="meals">'+ mealsAvailable + '</select>'+
    '</div>'+
    '<div class="large-3 columns addBtn" style="padding-left: 0">'+
    '<button onclick="addMeal(this)">Add to menu</button>'+
    '</div>'+
    '</div>';
    var parent = elem.parentNode.parentNode;
    console.log($('#'+parent.id).find('.meals').val());
    $.get('canteen_json.php',{add_currentMeal:1,current_meal_name: $('#'+parent.id).find('.meals').val()},function(data,status){
        //do the below on successful add to db
        elem.className += " alert";
        elem.innerHTML = 'Remove';
        $('#dataRows').append(newMealDOM);
        elem.setAttribute('onclick', 'remMeal(this)');
    }).done(function(){
        mealRows++;
    });
}
function remMeal(elem){

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



