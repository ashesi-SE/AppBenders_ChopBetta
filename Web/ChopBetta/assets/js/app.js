/**
 * Created by HP on 9/24/2014.
 */


var userData = "";//Values are set by login handlers

$(document).ready(function(){
    /**
     * Login n logout handlers
     */
    console.log("loginStart");
    $.get('canteen_loginHandler.php',{isAuthenticated:2},function(data){

        if(data){
            userData = data.dat;
            generateMealList();
            generateCurMealList();
            console.log(userData);
        }
    },"json");

    $('#login').submit(function(e){
        e.preventDefault();
        console.log('click');
        $.get('./canteen_loginHandler.php',{username: $('#username').val(),
            password: $('#password').val(),isAdmin:$('#isAdmin:checked').length==1?1:0},function(data,status) {
            console.log(data);
            if (data.stat == "VALID") {
                userData = data.dat;
                console.log(userData);
                if (userData.vendor_name == "superAdmin")
                    window.location.href = "super_user.php";
                else
                    window.location.href = "main.php";
            }else{
                if (data.stat=="NOU"){

                    $.get('http://localhost:63342/MealPlanEnhancement/php/mpe_loginHandler.php',{username: $('#username').val(),
                        password: $('#password').val()},function(data){
                        if(data){
                            showMsg({msg: "Redirecting.",type:"Information"});
                            window.location.href = "http://localhost:63342/MealPlanEnhancement/admin_console.php";
                        }else{
                            showMsg({msg: "The username you entered was not found.",type:"Warning"});
                        }
                    });

                }else{
                    showMsg({msg: "Sorry, Invalid password. Try again.",type:"Warning"});
                }
            }
        },"json");
    });

    $('#logout').click(function(){
        $.get('canteen_loginHandler.php',{logout: "x"}).done(function(){
            window.location.href = "index.php";
        });
    });

    $('#isAdmin').click(function(){
        if(this.checked){
            $('#username').attr('readonly','readonly').val('superAdmin');

        }else{
            $('#username').removeAttr('readonly').val('');
        }
    });

    /**
     * Event handler for modal open
     */
    $(document).on('opened.fndtn.reveal', '[data-reveal]', function () {
        var modal = $(this);
        var modalId = modal['context'].id;
        if(modalId == 'add_foodItem_modal'){
            $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
                if(data.length > 0){
                    $('#foodList ul').html("");
                }
                $.each(data,function(key, elem  ){
                    $('#foodList ul').append('<li class="'+elem.item_id +'">'+elem.item_name+'<span onclick="remFood('+elem.item_id+')"><i class="icon-delete"></i></span></li>');
                });
            },"json");

        }else if(modalId == 'create_meal_modal'){
            $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
                $('#create_meal_modal').find('.displayArea').html("No food items selected");
                mapDS.clear();
                if(data.length > 0){
                    $('#selectableFoodList ul').html("");
                }
                $.each(data,function(key, elem  ){
                    $('#selectableFoodList ul').append(
                        '<li class="'+elem.item_id +'">' +
                        '<input type="checkbox" name="'+elem.item_name +'" value="'+elem.item_id +'" id="'+elem.item_id +'">' +
                        '<label for="'+elem.item_id +'">'+elem.item_name +'<span><i class="icon-check"></i></span></label>' +
                        '</li>');
                });

                //mealList here

                //click function for food list
                $('#selectableFoodList').find('input[type=checkbox]').click(function(){
                    var elemId = $(this)['context'].id;
                    var clickedFoodItem = $('#'+ elemId + ':checked');
                    var uncheckedFoodItem = $('#'+ elemId);
                    console.log(clickedFoodItem);

                    if(clickedFoodItem.length == 1) {
                        mapDS.add(clickedFoodItem.val(),clickedFoodItem.attr('name'));
                    }else{
                        mapDS.remove(uncheckedFoodItem.val());
                    }
                    //  $('#create_meal_modal').find('.displayArea').html(mealArray.join(", "));
                    $('#create_meal_modal').find('.displayArea').html(makeHRString({data:mapDS.valArray(),dataType:"array"}));
                    console.log(mapDS.toArray());
                });

            },"json");
            generateMealList();
            var mealListAjax = generateMealList2();
            mealListAjax.done(function(){
                //onclick fubctions here to
            });
        }
        console.log(modal);
    });
});


/**
 * generateMealList() creates meal list for a specified canteen
 * <option>{meal here}</option> part
 */
//TODO: find a way to merge the 2 below methods
function generateMealList(){
    console.log("CID: "+userData.cid);
    var mealsAvailable = "";
    $.get('canteen_json.php',{display_mealList: 2,cid:userData.cid},function(data){
        console.log(data);
        $.each(data,function(key, elem  ){
            var mealStr = makeHRString({data:elem.meal_name});
            mealsAvailable += '<option name="'+ elem.meal_id +'" value="'+mealStr+'">'+mealStr+'</option>';
        });
        $('#addMealRow').find('.meals').html(mealsAvailable);
    },"json");
}
/*Meal list in the modal*/
function generateMealList2(){
    return $.get('canteen_json.php',{display_mealList: 2,cid:userData.cid},function(data){
        if(data.length >= 0){
            $('#mealList ul').html("");

            $.each(data,function(key, elem  ){

                $('#mealList ul').append('<li class="'+elem.meal_id +'">'+makeHRString({data:elem.meal_name})+'<span onclick="rem_fromMealList('+elem.meal_id+')"><i class="icon-delete"></i></span></li>');
            });
        }
    },"json");
}
function add_toMealList(){
    if($('#create_meal_modal').find('.displayArea').html()=="No food items selected"){
        showMsg({msg: "You have selected no items. Please select food items from the list on the left first"});
    }else {
        $.get('canteen_json.php', {add_mealList: 2, cid: userData.cid, meal_name: mapDS.toArray(true)},
            function (data) {
                if (data == 1) {
                    showMsg({msg: "added"});
                    generateMealList2();
                    generateMealList();
                } else {
                    showMsg({msg: "Could not update your list of available meals",type:"Warning"});
                    generateMealList2();
                    generateMealList();
                }
                $('#create_meal_modal').find('.displayArea').html("No food items selected");
                mapDS.clear();
                $('#selectableFoodList ul').each(function (key,elem) {
                    console.log(elem);
                    elem.attr("checked","false");
                })
            });
    }
}
function rem_fromMealList(meal_id){
    $.get('canteen_json.php', {delete_mealList: 2, cid: userData.cid, meal_id: meal_id},
        function (data) {
            console.log(data);
            if (data == 1) {
                showMsg({msg: "Deleted"});
                generateMealList2();
                generateMealList();
            } else if (data=="foreign") {
                showMsg({msg: "Please remove meal from the menu before deleting from here", type: "Warning"});
            }else {
                showMsg({msg: "Could not delete from your list of available meals", type: "Warning"});
            }

        });

}
function generateCurMealList(){
    var curListElem = $('#currentMealList').find('ul');
    $.get('canteen_json.php',{display_currentMeal: 2,cid:userData.cid},function(data){
        console.log(data);

        if(data.length >= 0){
            curListElem.html("");
        }
        $.each(data,function(key, elem){
            curListElem.append('<li class="meal' + elem.current_meal_id +'">'+
            '<span style="float: none; width: 75%;display: inline-block">'+elem.current_meal_name+'</span>'+
            '<span>' +
            setRatingStars(elem.customer_rating) +
            '<span onclick=remCurMeal("' + elem.current_meal_id + '") title="Delete item" class="icon-delete"></span>' +
            '</span></li>');
        });
    },"json");
}
function addCurMeal(elem){
    var parent = elem.parentNode.parentNode;
    $.get('canteen_json.php',{add_currentMeal:  1,
            cid:userData.cid,
            current_meal_name: $('#'+parent.id).find('.meals').val(),
            current_meal_id: $('#'+parent.id).find('.meals option:selected').attr('name')},
        function(data,status){
            if(data == 1){
                showMsg({msg:"The meal has been added to list"});
                generateCurMealList();
            }else{
                showMsg({msg:"Could not add, meal may already be in the list",type: "Warning"})
            }
        });
}
function remCurMeal(elem){
    $.get('canteen_json.php',{delete_currentMeal:1,cid:userData.cid,
            current_meal_id:elem},
        function(data){
            if(data == 1){
                showMsg({msg:"The meal was deleted from list"});
                generateCurMealList();
            }else{
                showMsg({msg:"Failed to delete the item",type: "Warning"})
            }
        });
}

function addFood(){
    $.get('canteen_json.php',{add_foodList: 2,item_name:$('#foodItem').val(),cid:userData.cid}).done(function(data){
        if(data==1){
            showMsg({msg:"Item added"})
        }
        $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
            if(data.length > 0){
                $('#foodList ul').html("");
            }
            $.each(data,function(key, elem){
                $('#foodList ul').append('<li class="'+elem.item_id +'">'+elem.item_name+'<span onclick="remFood('+elem.item_id+')"><i class="icon-delete"></i></span></li>');
            });
            $('#foodItem').val("");
        },"json");
    });
}
function remFood(foodId){
    $.get('canteen_json.php',{delete_foodList: 2,item_id:foodId,cid:userData.cid}).done(function(data){
        if(data==1){
            showMsg({msg:"Item deleted"})
        }
        $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
            if(data.length > 0){
                $('#foodList ul').html("");
            }
            $.each(data,function(key, elem){
                $('#foodList ul').append('<li class="'+elem.item_id +'">'+elem.item_name+'<span onclick="remFood(elem.item_id)"><i class="icon-delete"></i></span></li>');
            });
            $('#foodItem').val("");
        },"json");
    });
}


/**
 * Helper methods
 */
function makeHRString(options){
    var options = $.extend({data : "[hello]", dataType: "mealJson" }, options);
    if(options.dataType == "mealJson"){
        var meal = $.parseJSON(options.data); var mealStr = [];
        for (var i=0;i<meal.length;i++){
            mealStr.push(meal[i].value);
        }
    }else if(options.dataType == "array"){
        mealStr = options.data;
    }

    if(mealStr.length ==0){
        return "No food items selected";
    }else if(mealStr.length == 1){
        return mealStr[0];
    }else{
        var str =  mealStr.join(", ");
        var ind = str.lastIndexOf(",");
        return str.slice(0,ind) +" and"+ str.slice(ind+1,str.length);
    }
}
function setRatingStars(customer_rating) {
    var stars = "";
    for(var i=0;i<5;i++){
        if(i+0.2<customer_rating && i+0.9 >= customer_rating){
            stars += '<i class="icon-star-half"></i>';
        }else if(i+0.2<customer_rating) {
            stars += '<i class="icon-star-full"></i>';
        }else{
            stars += '<i class="icon-star-empty"></i>';
        }
    }
    return stars;
}
function showMsg(options){

    var options = $.extend({type : "info", msg: "Hello world!" }, options);

    var popup = '<section id="popup" class="popup centerPage"><div>stuff</div><span>&times;</span></section>';
    //check if popup exists in DOM before appending
    console.log($('#popup'));
    if ($('#popup').length==0)$('body').append(popup);

    popup = $('#popup');
    popup.hide();
    popup.find('span').css({ position: "fixed",
        "right": "3px",
        "top": "50%",
        "transform": "translateY(-50%)",
        "font-size": "25px"}).click(function(){
        //hides popup
        popup.hide('slideUp');
    });

    popup.css({ position: "fixed",
        "top": "48px",
        "left": 0,
        "right": 0,
        "background":" rgba(245, 245, 220,0.67)",
        "border": "1px solid rgb(218, 218, 184)",
        "border-radius": "4px",
        "line-height": "17px",
        "padding": "10px",
        "z-index": 4000});
    if(options.type == "Warning"){
        popup.css({"background": "rgba(255, 193, 163,0.67)", "border": "1px solid rgb(235, 134, 41)"});
    }
    popup.find('div').html(options.msg);

    popup.slideDown();
    setTimeout(function(){popup.fadeOut()}, 3000);

}


