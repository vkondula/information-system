<?php
session_start();
require_once("../database.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: /frontend/log_form.php");
    exit;
}

function go_back(){
    header("Location: /frontend/examination.php");
    exit;
}

$db = new Database();
$req = 'INSERT INTO VYKON VALUES (NULL, ?, ?)';
if(empty($_POST["number"])) $expire = null;
else $expire = $_POST["number"];
$vals = array($_POST["name"], $expire);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Přidání výkonu do databáze selhalo";
}
go_back();