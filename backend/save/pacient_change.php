<?php
session_start();
require_once("../database.php");
require_once ("../patient.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back($changed=false){
    if ($changed) $rc = $_POST["rc"];
    else $rc = $_POST["id_p"];
    header("Location: /frontend/pacient.php?id=".$rc);
    exit;
}

if(!is_insurance_in_db($_POST["insurance"])){
    $_SESSION["error"] = "Chybné číslo pojišťovny";
    go_back();
}

if(!is_rc_valid($_POST["rc"])){
    $_SESSION["error"] = "Invalidní rodné číslo";
    go_back();
}

if($_POST["rc"] != $_POST["id_p"] && !is_rc_uniq($_POST["rc"])){
    $_SESSION["error"] = "Pacient s tímto rodným číslem již existuje";
    go_back();
}

if(!is_all_set($_POST, ["fname","surname", "rc","insurance", "street", "str_number", "city", "postal_code"])){
    $_SESSION["error"] = "Nebyly zadány všechny povinné položky";
    go_back();
}

$b_date = substr($_POST["rc"], 0, 6);
if((int)substr($_POST["rc"], 2, 1) > 1) $b_date = (int)$b_date - 5000;
$b_date = date_create_from_format("Ymd", $b_date);

$db = new Database();
$req = 'UPDATE PACIENT SET 
    ID_RC = ?, JMENO = ?, PRIJMENI = ?, ULICE = ?, CISLO_POPISNE = ?,
    MESTO = ?, PSC = ?, DATUM_NAROZENI = ?, ID_POJISTOVNA = ?
    WHERE ID_RC = ?;';
$vals = array($_POST["rc"], $_POST["fname"],$_POST["surname"], $_POST["street"], $_POST["str_number"], $_POST["city"], $_POST["postal_code"], $b_date, $_POST["insurance"], $_POST["id_p"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Změna údajů pacienta selhala";
    $db->send_query("SET foreign_key_checks = 1;", array());
    go_back();
};
go_back(true);