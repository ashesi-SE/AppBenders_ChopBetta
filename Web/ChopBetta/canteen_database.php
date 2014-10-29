<?php

//define("DB_host", "127.0.0.1");
define("DB", "canteen");
//define("DB_user", "root");
//define("DB_pass", "");

//define("DB_host", "localhost");
//define("DB", "csashesi_shamir-adjaku");
//define("DB_user", "csashesi_sa15");
//define("DB_pass", "db!829187");

//define("DB",  $_SERVER['RDS_DB_NAME']);
define("DB_user", $_SERVER['RDS_USERNAME']);
define("DB_pass",  $_SERVER['RDS_PASSWORD']);
define("DB_host", $_SERVER['RDS_HOSTNAME']);
define("DB_port", $_SERVER['RDS_PORT']);

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

        //0$this->link=mysqli_connect(DB_host,DB_user,DB_pass,DB);
        /*FOR AWS*/
        $this->link=mysqli_connect(DB_host,DB_user,DB_pass,DB);

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
