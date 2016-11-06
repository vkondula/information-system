<?php
session_start();
require_once("database.php");
require_once ("person.php");
$email = $_POST["email"];
$password = $_POST["password"];
if (log_in($email, $password)){
    header("Location: ../index.php");
    exit;
} else {
    $_SESSION["error"] = "Chybný email nebo heslo!";
    header("Location: ../login.php");
    exit;
}