<?php
session_start();
require_once("../database.php");
require_once ("../patient.php");
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

$db = new Database();
$req = 'INSERT INTO FAKTURA VALUES (NULL, ?, ?, ?, ?)';
$vals = array($_POST["date"], $_POST["price"], $_POST["extra"], $_POST["id_v"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Vytvoření faktury";
}
go_back();