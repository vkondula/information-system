<?php
session_start();
require_once("frontend/shared.php");
require_once("backend/person.php");
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: login.php");
    exit;
}
$s = new Site;
$s->print_header();
$s->print_logout();
echo "congratulation, you are logged in as:\n";
$user = whois_logged();
var_dump($user);



# THE END
$s->print_footer();