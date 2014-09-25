/**
 * Created by HP on 9/24/2014.
 */

var mealRows = 1;
var foods = "";
$(document).ready(function(){
    //gets food available
    $.get('sample.php',{statusSet: 2},function(data){
        $.each(function(){
            // foods+='<option value="husker">'+data[itemname]+'</option>'
        });
        console.log(data);
    },"json");
});



function addtoMenu(elem){

    var parent = elem.parentNode.parentNode;
    alert(parent);
    console.log(e);
    var addMealRow = ' <div class="row" id="addMealRow'+mealRows+'">'+

    '<div class="large-9 columns" style="padding-left: 0">'+
        '<select id="meals">'+
            '<option value="husker">Husker</option>'+
            '<option value="starbuck">Starbuck</option>'+
            '<option value="hotdog">Hot Dog</option>'+
            '<option value="apollo">Apollo</option>'+
        '</select>'+
    '</div>'+
    '<div class="large-3 columns addBtn" style="padding-left: 0">'+
    '<button onclick="addtoMenu(this)">Add to menu</button>'+
    '</div>'+
    '</div>';
    parent.css({"color":'green'});
   $('#adder').prepend(addMealRow);


}
function showMsg(type,msg,options){
    var options = $.extend({type : "info", speed : 40, mousestop : true }, options);

}

