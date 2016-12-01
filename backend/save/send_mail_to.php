<?php
session_start();

function go_back(){
    header("Location: /frontend/pacients.php");
    exit;
}

if(!mail($_POST["address"], $_POST["subject"], $_POST["message"])){
    $_SESSION["error"] = "Zaslání zprávy selhalo";
}
go_back();
?>