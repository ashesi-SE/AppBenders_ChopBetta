<?php
define("DB", "canteen");
class db{
    var $result;
    var $link;
    var $str_error;

    function db(){

        $this->link=false;
        $this->str_error="";
        $this->result=false;
    }
    //connects to link (localhost)and selects chosen database(eg:webtech)
    function connect(){
        if($this->link){
            return true;
        }

        $this->link=mysqli_connect("localhost","root","",DB);

        if(!$this->link){
            $this->str_error="failed to connect to db";
            return false;
        }

        if(!mysqli_select_db($this->link,DB)){
            $this->str_error="db not found";
            return false;
        }

        return true;

    }

    function sql_query($query){
        if(!$this->connect()){
            return false;
        }

        $this->result=mysqli_query($this->link,$query);
        if(!$this->result){
            $this->str_error=mysqli_error($this->link);
            return false;
        }

        return true;
    }
    function fetch(){
        if(!$this->result){
            return false;
        }

        return mysqli_fetch_assoc($this->result);

    }
    function nextField(){
        if(!$this->result){
            return false;
        }

        return mysqli_fetch_field($this->result);
    }
    function get_num_rows(){
        return mysqli_num_rows($this->result);
    }

    function get_id(){
        return mysqli_insert_id($this->link);
    }

}


?>