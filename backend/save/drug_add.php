<?php
session_start();
require_once("../database.php");
require_once ("../drugs.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back(){
    header("Location: /frontend/drugs.php");
    exit;
}

$db = new Database();
$req = 'INSERT INTO LEK VALUES (NULL, ?, ?, ?)';
$vals = array($_POST["name"], $_POST["drug_type"], $_POST["description"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Přidání léku do databáze selhalo";
}
go_back();