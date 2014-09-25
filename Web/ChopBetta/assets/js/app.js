/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var foods = "";
var addMealRow = "";
$(document).ready(function(){
    //gets food available
    $.get('sample.php',{statusSet: 2},function(data){
<<<<<<< HEAD
        $.each(function(){
             foods+='<option value="husker">'+data[itemname]+'</option>'
=======
        $.each(data,function( key, elem  ){
             foods+='<option value="husker">'+elem.itemname+'</option>'
>>>>>>> 77f9c9f55f6dba8cb253acdf064a3621ef123aca
        });
        console.log(foods);
    },"json");

addMealRow = ' <div class="row" id="addMealRow'+mealRows+'">'+

    '<div class="large-9 columns" style="padding-left: 0">'+
    '<select id="meals">'+
    foods +
    '</select>'+
    '</div>'+
    '<div class="large-3 columns addBtn" style="padding-left: 0">'+
    '<button onclick="addtoMenu(this)">Add to menu</button>'+
    '</div>'+
    '</div>';
});

function addtoMenu(elem){

    var parent = elem.parentNode.parentNode;
    alert(parent);
    console.log(e);

    parent.css({"color":'green'});
   $('#adder').prepend(addMealRow);


}
function showMsg(type,msg,options){
    var options = $.extend({type : "info", speed : 40, mousestop : true }, options);

}

