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
    header("Location: /frontend/pacient.php?id=".$_POST["id_p"]."&v=".$_POST["id_v"]);
    exit;
}

$db = new Database();
$req = 'DELETE FROM FAKTURA WHERE ID_FAKTURY = ?;';
$vals = array($_POST["id_bill"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Odstranění faktury selhalo";
}
go_back();
