<?php
session_start();
require_once("frontend/shared.php");
require_once ("backend/person.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: login.php");
    exit;
}
if (!empty($_SESSION["error"])){
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
}
$s = new Site;
$s->set_title("Nastavení hesla");
$s->print_header();
$s->print_error();
$s->print_password_form();
$s->print_footer();