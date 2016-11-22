<?php
session_start();
require_once("../database.php");
require_once("../person.php");
require_once("../employees.php");
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
    $_SESSION["error"] = "Sestra nemůže mazat zaměstnance";
    go_back();
}

# USER CAN'T DELETE HIMSELF
if ($user->email == $_POST["delete_id"]){
    $_SESSION["error"] = "Nemůžete smazat sami sebe";
    go_back();
}

# THERE MUST ALWAYS BE AT LEAST ONE DOCTOR
if (get_doctor_count_except($_POST["delete_id"]) == 0){
    $_SESSION["error"] = "V systému musí být alespoň jeden doktor";
    go_back();
}

$db = new Database();
$req = 'DELETE FROM ZAMESTNANEC WHERE EMAIL = ?;';
$vals = array($_POST["delete_id"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Odstranění zaměstnance selhalo";
}
go_back();