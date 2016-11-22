<?php
session_start();
require_once("../database.php");
require_once ("../patient.php");
require_once ("../drugs.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back(){
    header("Location: /frontend/pacient.php?id=".$_POST["id_p"]."&v=".$_POST["id_v"]);
    exit;
}

if(!is_rc_valid($_POST["id_p"])){
    $_SESSION["error"] = "Invalidní rodné číslo";
    go_back();
}

if(is_rc_uniq($_POST["id_p"])){
    $_SESSION["error"] = "Pacient neexistuje!";
    go_back();
}

$drug_id = find_drug($_POST["name"]);
if ($drug_id == null){
    $_SESSION["error"] = "Tento lék není v databázi";
    go_back();
}

$db = new Database();
$req = 'INSERT INTO TERMIN_LEK VALUES (?, ?, ?)';
$vals = array($_POST["id_v"], $drug_id, $_POST["number"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Předepsání léku selhalo";
}
go_back();
