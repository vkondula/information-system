<?php
session_start();
require_once("../database.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back(){
    header("Location: /frontend/insurance.php");
    exit;
}

$db = new Database();
$req = 'INSERT INTO POJISTOVNA VALUES (?, ?)';
$vals = array($_POST["id_ins"], $_POST["name"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Přidání pojišťovny do databáze selhalo";
}
go_back();