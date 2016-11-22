<?php
session_start();
require_once("../database.php");
require_once("../person.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back(){
    header("Location: /frontend/employee.php");
    exit;
}

# NURSE CAN'T ADD EMPLOYEES
$user = whois_logged();
if (!$user->is_doctor()){
    $_SESSION["error"] = "Sestra nemůže přidávat zaměstnance";
    go_back();
}

$db = new Database();
$req = 'INSERT INTO ZAMESTNANEC VALUES (?, ?, ?, NULL, ?)';
$vals = array($_POST["email"], $_POST["fname"], $_POST["surname"], $_POST["doctor"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Přidání léku do databáze selhalo";
}
go_back();