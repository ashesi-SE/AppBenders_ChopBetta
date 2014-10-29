

var cafetria_ids=[];
var cafetria_names=[];
var c=0 ;

$(document).ready(function(){
startTime();
//get number of cafetria to create tabs
    $.get('../ChopBetta/canteen_json.php?display_cafeteria',function(data,status){
        for(var i=0;i<data.length;i++){
            cafetria_ids[i]=data[i].cafeteria_id;
            cafetria_names[i]=data[i].cafeteria_name;
        }

        var tabs="";
        var tabContent = "";
        //build tabs
        for (var j=0;j<cafetria_ids.length;j++){
            if(tabs==""){
                tabs+='<dd class="active"><a href="#panel'+cafetria_ids[j]+'">'+cafetria_names[j]+'</a></dd>'
            }
            else{
                tabs+='<dd><a href="#panel'+cafetria_ids[j]+'">'+cafetria_names[j]+'</a></dd>'
            }
        }
        $(tabs).appendTo('#tabs');
        // end build tabs
    },"json")
 .done(function(){
            console.log("done");
            getMealsBasedOnCafeteriaIds();
        });

//now get content of tabs


 });

function getMealsBasedOnCafeteriaIds(){

    c=0;
    for (var i=0;i<cafetria_ids.length;i++){
         $.get('../ChopBetta/canteen_json.php?display_currentMeal&cid='+cafetria_ids[i]+'',function(status){
         }    ,"json")
         .done(function(data){
            console.log(data);
                 if (data.length>=1) {
                     var content;
                     if(c==0) {
                         content = '<div style="margin: 0 auto; max-width: 500px;" class="content active" id="panel' + data[0].cid + '">';
                         c=1;
                     }
                     else {
                         content = '<div style="margin: 0 auto; max-width: 500px;" class="content" id="panel' + data[0].cid + '">';
                     }
                     for (var j = 0; j < data.length; j++) {
                         content += '<div class="card"><p>' + data[j].current_meal_name + '</p></div>';
                     }
                     content += '</div>';
                     $(content).appendTo('#tab_content');
                 }

         });
    }
}

function checkTime(i) {
    if (i < 10) {
        i = "0" + i;
    }
    return i;
}

function startTime() {
    var today = new Date();
    var h = today.getHours();
    var m = today.getMinutes();
    var s = today.getSeconds();
    // add a zero in front of numbers<10
    m = checkTime(m);
    s = checkTime(s);
    document.getElementById('time').innerHTML = h + ":" + m + ":" + s;
    document.getElementById('time1').innerHTML = h + ":" + m + ":" + s;
    t = setTimeout(function () {
        startTime()
    }, 500);
}

