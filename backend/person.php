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

}

function log_in($email, $password){
    # password must be already in sha256
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