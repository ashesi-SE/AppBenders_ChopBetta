/**
 * Created by HP on 10/2/2014.
 */


var mapDS = new function() {
    var key = [];
    var value = [];
    this.length = 0;
    this.add = function (index, val) {
        key.push(index);
        value.push(val);
        this.length++;
    };
    this.remove = function (index) {
        console.log(key);
        console.log(index);
        var valIndex = $.inArray(index,key);
        console.log(valIndex);
        key = $.grep(key, function (n,i) {
            return i !== valIndex;
        });
        value = $.grep(value, function (n,i) {
            return i !== valIndex;
        });
        this.length--;
    };

    this.toArray = function (serialize) {
        serialize = serialize || false;
        var final = [];
        $.each(key,function(index,data){
            var item = {};
            item.key = data;
            item.value = value[index];
            final.push(item);
        });

        return (serialize)? final.toString(): final;

    };

};