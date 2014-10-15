/**
 * Created by Eyram on 14/10/2014.
 */



$(document).ready(function () {
    $('#cafeteria_vendor_box').hide();
});

function addCafeteria() {
    $('#cafeteria_name_box').slideUp();
    $('#cafeteria_vendor_box').slideDown();
}

function createNewCafeteria() {
    $('#cafeteria_name_box').show();
    $('#cafeteria_vendor_box').hide();
}

function editCafeteria() {

}

function deleteCafeteria() {
    var r = confirm("Deleting a cafeteria would remove all information about the cafeteria " +
        "including food items,meals,vendors and current meals.\nWould you like to delete it?");
    if (r == true) {
        //make call to delete
    } else {
        //return to screen
    }
}