<?php
session_start();
require_once("database.php");
require_once ("person.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    var_dump(whois_logged());
    //header("Location: ../login.php");
    exit;
}
$user = whois_logged();
$password1 = $_POST["password1"];
$password2 = $_POST["password2"];


if ($password1 != $password2) {
    $_SESSION["error"] = "Hesla se liší.";
    header("Location: ../frontend/pass_form.php");
    exit;
}

if ($user->verify_password($password1)) {
    if ($user->set_password($password1)){
        unset($_SESSION["login_user"]);
        $_SESSION["error"] = "Heslo nastaveno. Prosím přihlašte se novým heslem.";
        header("Location: ../index.php");
    } else {
        $_SESSION["error"] = "Heslo nelze nastavit.";
        header("Location: ../frontend/pass_form.php");
    }
} else {
    $_SESSION["error"] = "Heslo není dostatečně silné.";
    header("Location: ../frontend/pass_form.php");
    exit;
}