/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var mealsAvailable = "";
var userData = "";//Values are set by login handlers
var newMealDOM = "";
$(document).ready(function(){
    /**
     * Login n logout handlers
     */
    $.get('canteen_loginHandler.php',{isAuthenticated:2},function(data){

        if(data){
            userData = data.dat;
            generateMealList();
            console.log(userData);
        }

    },"json");

    $('#login').submit(function(e){
        e.preventDefault();
        $.get('canteen_loginHandler.php',{username: $('#username').val(),
            password: $('#password').val()},function(data,status) {
            console.log(data);
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
                    $('#foodList ul').append('<li class="'+elem.item_id +'">'+elem.item_name+'</li>');
                });
            },"json");

        }else if(modalId == 'create_meal_modal'){
            $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
                if(data.length > 0){
                    $('#selectableFoodList ul').html("");
                }
                $.each(data,function(key, elem  ){
                    $('#selectableFoodList ul').append(
                        '<li class="'+elem.item_id +'">' +
                        '<input type="checkbox" name="'+elem.item_name +'" value="'+elem.item_id +'" id="'+elem.item_id +'">' +
                        '<label for="'+elem.item_id +'">'+elem.item_name +'</label>' +
                        '</li>');
                });
            },"json").done(function(){
                //Click function
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
                    $('#create_meal_modal').find('.displayArea').html(makeHRString(mapDS.valArray()));
                    console.log(mapDS.toArray());
                });

            });
        }

        console.log(modal);
    });
});


/**
 * Creates meal list for a specified canteen
 * <option>{meal here}</option> part
 */
function generateMealList(){
    console.log("CID: "+userData.cid);
    return $.get('canteen_json.php',{display_mealList: 2,cid:userData.cid},function(data){

        console.log(data);
        $.each(data,function(key, elem  ){
            var meal = $.parseJSON(elem.meal_name); var mealStr = [];

            for (var i=0;i<meal.length;i++){
                mealStr.push(meal[i].value);
            }
            mealStr = makeHRString(mealStr);
            mealsAvailable += '<option name="'+ elem.meal_id +'" value="'+mealStr+'">'+mealStr+'</option>';
        });

        $('#addMealRow1').find('.meals').html(mealsAvailable);
    },"json");

}
function add_toMealList(){
    $.get('canteen_json.php',{add_mealList: 2,cid:userData.cid,meal_name:mapDS.toArray(true)},
        function(data){
            showMsg({msg:"added"});
        //TODO: popup on true or 1
    });
}

function addCurMeal(elem){

    function createRow(){
        newMealDOM = ' <div class="row" id="addMealRow'+(++mealRows)+'">'+
        '<div class="large-9 columns" style="padding-left: 0">'+
        '<select class="meals">'+ mealsAvailable + '</select>'+
        '</div>'+
        '<div class="large-3 columns addBtn" style="padding-left: 0">'+
        '<button onclick="addCurMeal(this)">Add to menu</button>'+
        '</div>'+
        '</div>';
        return newMealDOM;
    }
    var parent = elem.parentNode.parentNode;

    console.log($('#'+parent.id));
    console.log($('#'+parent.id).find('.meals').val());
    console.log($('#'+parent.id).find('.meals option:selected').attr('name'));
    $.get('canteen_json.php',{add_currentMeal:  1,
            cid:userData.cid,
            current_meal_name: $('#'+parent.id).find('.meals').val(),
            current_meal_id: $('#'+parent.id).find('.meals option:selected').attr('name')},
        function(data,status){
            console.log(data);
            //todo: the below on successful add to db
            //TODO: popup on true or 1
            elem.className += " alert";
            elem.innerHTML = 'Remove';
            elem.setAttribute('onclick', 'remCurMeal(this)');
            $('#dataRows').append(createRow());
        });
}
function remCurMeal(elem){
    var parent = elem.parentNode.parentNode;
    console.log(parent.id);
    $('#'+parent.id).remove();
    //TODO: popup on true or 1
}


function addFood(){
    $.get('canteen_json.php',{add_foodList: 2,item_name:$('#foodItem').val(),cid:userData.cid}).done(function(){
        //TODO: popup on true or 1
        $.get('canteen_json.php',{display_foodList: 2,cid:userData.cid},function(data){
            if(data.length > 0){
                $('#foodList ul').html("");
            }
            $.each(data,function(key, elem  ){
                $('#foodList ul').append('<li class="'+elem.item_id +'">'+elem.item_name+'</li>');
            });
            $('#foodItem').val("");
        },"json");
    });
}

function makeHRString(kvMap){
    //TODO: nothing selected
    if(kvMap.length == 1){
        return kvMap[0];
    }else{
        var str =  kvMap.join(", ");
        var ind = str.lastIndexOf(",");
        return str.slice(0,ind) +" and"+ str.slice(ind+1,str.length);
    }
}
function showMsg(options){

    function close(elem){

    }
    var options = $.extend({type : "info", msg: "Hello world!" }, options);

    var popup = '<section id="popup" class="popup centerPage"><div>stuff</div><span>&times;</span></section>';
    $('body').append(popup);
    var popup = $('.popup');
    popup.hide();
    popup.find('span').css({ position: "absolute",
    "right": "3px",
    "top": "50%",
    "transform": "translateY(-50%)",
    "font-size": "25px"}).click(function(){
        //TODO: hide via clickeds id
        popup.hide('slideTop');
    });

    popup.css({ position: "absolute",
    "top": "55px",
    "left": 0,
    "right": 0,
    "background": "beige",
    "border": "1px solid rgb(218, 218, 184)",
    "border-radius": "4px",
    "line-height": "17px",
    "padding": "10px",
    "z-index": 400});
    popup.find('div').html(options.msg);

    popup.show('slideTop');
    setTimeout(function(){popup.hide('slideTop')}, 2000);

}


