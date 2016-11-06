<?php
session_start();
unset($_SESSION["login_user"]);
require_once("frontend/shared.php");
require_once ("backend/person.php");
if (!empty($_SESSION["error"])){
    echo $_SESSION["error"];
    unset($_SESSION["error"]);
}
$s = new Site;
$s->set_title("Příhlášení");
$s->print_header();
$s->print_login_form();
$s->print_footer();