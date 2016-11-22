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
$req = 'DELETE FROM VYKON WHERE ID_VYKONU = ?;';
$vals = array($_POST["delete_id"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Smazání výkonu selhalo";
}
go_back();
