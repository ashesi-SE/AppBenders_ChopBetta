/**
 * Created by Eyram on 14/10/2014.
 */

var cafeteria_id = 0;

$(document).ready(function () {
    $('#cafeteria_vendor_box').hide();
    updateTable();
});

function updateTable() {
    $.get('canteen_json.php', {display_cafeteria: 2}, function (data) {
        console.log("all cafeterias");
        console.log(data);
        $('#table_content').empty();
        var table_content = '';
        for (var i = 0; i < data.length; i++) {
            table_content += '<tr>' +
                '<td>' + data[i].cafeteria_name + '</td>' +
                '<td style="text-align: center;"><a href="#" data-reveal-id="edit_cafeteria_modal" onclick="editCafeteria(' + data[i].cafeteria_id + ',\'' + data[i].cafeteria_name + '\')"><span title="Edit item" class="icon-edit"></span></a></td>' +
                '<td style="text-align: center;"><a href="#"  onclick="deleteCafeteria(' + data[i].cafeteria_id + ')"><span title="Delete item" class="icon-delete"></span></a></td>' +
                '</tr>';
        }
        $(table_content).appendTo('#table_content');
    }, "json");
}

function addCafeteria(whatToDo) {
    if (whatToDo == 1) {
        //add cafeteria
        $.get('canteen_json.php', {add_cafeteria: 2, cafeteria_name: $('#cafeteria_name').val()}, function (data) {
            //get id of the just added cafeteria
            $.get('canteen_json.php', {get_cafeteria_id: 2, cafeteria_name: $('#cafeteria_name').val()}, function (data) {
                console.log(data);
                cafeteria_id = data[0].cafeteria_id;
                console.log("Cafeteria_id is " + cafeteria_id);
                $('#cafeteria_name_box').slideUp();
                $('#cafeteria_vendor_box').slideDown();
                //add vendor for the cafeteria

            }, "json");
        }, "json");
    }
    else {
        $.get('canteen_json.php', {add_vendor: 2, vendor_name: $('#vendor_name').val(), vendor_password: $('#vendor_password').val(), cid: cafeteria_id}, function (data) {
            console.log(data);
            updateTable();
            showMsg({msg: "Cafeteria has been created"});
            $('#create_meal_modal').foundation('reveal', 'close');
        }, "json");
    }
}

function showMsg(options) {

    function close(elem) {

    }

    var options = $.extend({type: "info", msg: "Hello world!" }, options);

    var popup = '<section id="popup" class="popup centerPage"><div>stuff</div><span>&times;</span></section>';
    $('body').append(popup);
    popup = $('.popup');
    popup.hide();
    popup.find('span').css({ position: "absolute",
        "right": "3px",
        "top": "50%",
        "transform": "translateY(-50%)",
        "font-size": "25px"}).click(function () {
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
    if (options.type == "Warning") {
        popup.css({"background": "rgb(255, 193, 163)", "border": "1px solid rgb(235, 134, 41)"});
    }
    popup.find('div').html(options.msg);

    popup.show('slideTop');
    setTimeout(function () {
        popup.hide('slideTop')
    }, 2000);

}

function createNewCafeteria() {
    $('#cafeteria_name_box').show();
    $('#cafeteria_vendor_box').hide();
}

function editCafeteria(cafeteria_id, cafeteria_name) {
    var cafeteria_name_field = $('#edit_cafeteria_name');
    $('#edit_cafeteria_id').val(cafeteria_id);
    var vendor_name_field = $('#edit_vendor_name');
    var vendor_id_field = $('#edit_vendor_id');
    cafeteria_name_field.val(cafeteria_name);

    //get vendor info
    $.get('canteen_json.php', {display_vendor: 2, cid: cafeteria_id}, function (data) {
        console.log(data);
        vendor_name_field.val(data[0].vendor_name);
        vendor_id_field.val(data[0].vendor_id);
    }, "json");
}

function saveEditCafeteria() {
    var cafeteria_name_field = $('#edit_cafeteria_name').val();
    var vendor_name_field = $('#edit_vendor_name').val();
    var password_name_field = $('#edit_password').val();
    var vendor_id_field = $('#edit_vendor_id').val();
    var isChecked = $('#checkbox2').is(':checked');
    var cafeteria_id = $('#edit_cafeteria_id').val();
    console.log("done");
    if (isChecked && password_name_field != "") {
        $.get('canteen_json.php', {update_vendor: 2, vendor_id: vendor_id_field, vendor_password: password_name_field, cid: cafeteria_id, vendor_name: vendor_name_field}, function (data) {
            console.log("done with first");
        }, "json");
        console.log("middle");
        $.get('canteen_json.php', {update_cafeteria: 2, cafeteria_id: cafeteria_id, cafeteria_name: cafeteria_name_field}, function (data) {
            console.log("done with second");
        }, "json");
        updateTable();
        showMsg({msg: "Changes have been saved"});
        $('#edit_cafeteria_modal').foundation('reveal', 'close');
    }
    else {
        $.get('canteen_json.php', {update_vendor_non_password: 2, vendor_id: vendor_id_field, cid: cafeteria_id, vendor_name: vendor_name_field}, function (data) {
            console.log(data);

        }, "json");
        $.get('canteen_json.php', {update_cafeteria: 2, cafeteria_id: cafeteria_id, cafeteria_name: cafeteria_name_field}, function (data) {
            console.log(data);
        }, "json");
        updateTable();
        showMsg({msg: "Changes have been saved"});
        $('#edit_cafeteria_modal').foundation('reveal', 'close');
    }

}

function deleteCafeteria(cafeteria_id) {
    var r = confirm("Deleting a cafeteria would remove all information about the cafeteria " +
        "including food items,meals,vendors and current meals.\nWould you like to delete it?");
    if (r == true) {
        //make call to delete
        $.get('canteen_json.php', {delete_cafeteria: 2, cafeteria_id: cafeteria_id}, function (data) {
            console.log(data);
            updateTable();
            showMsg({msg: "Deleted"});
            $('#edit_cafeteria_modal').foundation('reveal', 'close');
        }, "json");
    } else {
        //return to screen
    }
}