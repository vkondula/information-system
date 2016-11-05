<?php

function log_in($email, $password){
    return true;
}

class Person{
    public $id;
    public $password;
    public $email;

    public function __construct($id, $password, $email){
        $this->id=$id;
        $this->password=$password;
        $this->email=$email;
    }

}

class Pacient extends Person {

}