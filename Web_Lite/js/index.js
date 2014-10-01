

var cafetria_ids=[];
var cafetria_names=[];

$(document).ready(function(){
startTime();
//get number of cafetria to create tabs
    $.get('../../Web/ChopBetta/canteen_json.php?display_cafeteria',function(data,status){
        // console.log(data);
        for(var i=0;i<data.length;i++){
            cafetria_ids[i]=data[i].cafeteria_id;
            cafetria_names[i]=data[i].cafeteria_name;
        }
        // console.log(cafetria_ids);
        // console.log(cafetria_names);

        var tabs="";
        var tabContent = "";
        //build tabs
        for (var i=0;i<cafetria_ids.length;i++){
            if(tabs==""){
                tabs+='<dd class="active"><a href="#panel'+cafetria_ids[i]+'">'+cafetria_names[i]+'</a></dd>'
            }
            else{
                tabs+='<dd ><a href="#panel'+cafetria_ids[i]+'">'+cafetria_names[i]+'</a></dd>'
            }
        }
        $(tabs).appendTo('#tabs');
        // $(tabContent).appendTo('#tab_content');
        // end build tabs
    },"json")
 .done(function(){
            console.log("done");
            getMealsBasedOnCafeteriaIds();
        });

//now get content of tabs


 });

function getMealsBasedOnCafeteriaIds(){
    var c=0 ;
    for (var i=0;i<cafetria_ids.length;i++){
         $.get('../../Web/ChopBetta/canteen_json.php?display_currentMeal&cid='+cafetria_ids[i]+'',function(status){           
    
         }    ,"json") 
         .done(function(data){
            console.log(data);
            var content="";
            for (var j=0;j<data.length;j++){

                if (c==0){
                content+='<div class="content active" id="panel'+data[j].cid+'"> <div class="card">'+data[j].current_meal_name+'</div></div>';
                c=1;
            }
            else{
                content+='<div class="content" id="panel'+data[j].cid+'"> <div class="card">'+data[j].current_meal_name+'</div> </div>';
}
            }
            $(content).appendTo('#tab_content');
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

