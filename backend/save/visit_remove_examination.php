<?php
session_start();
require_once("../database.php");
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
$req = 'DELETE FROM TERMIN_VYKON WHERE ID_TERMINU = ? AND ID_VYKONU = ?;';
$vals = array($_POST["id_term"], $_POST["id_exam"]);
$q = $db->send_query($req, $vals);
if($q->get_count() != 1){
    $_SESSION["error"] = "Odebrání výkonu selhalo";
}
go_back();