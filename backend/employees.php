<?php
session_start();
require_once("database.php");

function get_employees(){
    $req = '
        SELECT EMAIL AS email, JMENO AS fname, PRIJMENI AS surname, DOKTOR AS doc
        FROM ZAMESTNANEC
        ORDER BY PRIJMENI ASC;
     ';
    $vals = array();
    $db = new Database();
    $q = $db->send_query($req, $vals);
    return $q->get_data();
}


function get_doctor_count_except($email){
    $req = 'SELECT EMAIL FROM ZAMESTNANEC WHERE EMAIL <> ? AND DOKTOR = 1;';
    $vals = array($email);
    $db = new Database();
    $q = $db->send_query($req, $vals);
    return $q->get_count();
}