<?php
session_start();
require_once("../database.php");
require_once ("../patient.php");
require_once ("../examination.php");
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

$exam_id = find_examination($_POST["name"]);
if ($exam_id == null){
    $_SESSION["error"] = "Tento výkon není v databázi";
    go_back();
}

$db = new Database();
$req = 'INSERT INTO TERMIN_VYKON VALUES (?, ?)';
$vals = array($_POST["id_v"], $exam_id);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Zápis výkonu selhal";
}
go_back();