/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var foods = "";
var mealInputRow = "";
$(document).ready(function(){
    //gets food available
    $.get('sample.php',{statusSet: 2},function(data){
        $.each(data,function( key, elem  ){
             foods+='<option value="'+elem.itemname+'">'+elem.itemname+'</option>'
        });

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
function addMealRow(elem){
    elem.className += " alert";
    elem.innerHTML = 'Remove';
    var parent = elem.parentNode.parentNode;
   $('#dataRows').append(setupRow(foods));


}
function showMsg(type,msg,options){
    var options = $.extend({type : "info", speed : 40, mousestop : true }, options);

}

