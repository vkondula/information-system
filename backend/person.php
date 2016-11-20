<?php

require_once ('database.php');

class Employee{
    public $email;
    public $password;
    public $name;
    public $surname;
    public $doctor;

    public function __construct($args){
        $this->password=$args["PASSWORD"];
        $this->email=$args["EMAIL"];
        $this->name=$args["JMENO"];
        $this->surname=$args["PRIJMENI"];
        $this->doctor=$args["DOKTOR"];
    }

    public function has_password(){
        return !empty($this->password);
    }

    public static function verify_password($pass){
        return true;
    }

    public function set_password($pass){
        $db = new Database();
        if(empty($pass)) return false;
        return $db->set_password($this->email, $pass);
    }

    public function is_doctor(){
        if ($this->doctor == 1 ){
            return true;
        }
        return false;
    }
}

function log_in($email, $password){
    $db = new Database();
    $args = $db->log_in($email, $password);
    if (!$args){
        return false;
    }
    session_start();
    $_SESSION['login_user'] = serialize(new Employee($args));
    return true;
}


function whois_logged(){
    if (isset($_SESSION['login_user'])){
        return unserialize($_SESSION['login_user']);
    }
    return null;
}