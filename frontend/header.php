<?php
# REDIRECT WHEN NOT LOGGED IN
if (!isset($_SESSION["login_user"])){
    header("Location: log_form.php");
    exit;
}
# REDIRECT TO CHANGE PASSPORT ON FIRST LOGIN
require_once("../backend/person.php");
$user = whois_logged();
if (!$user->has_password() and $title != "Změna hesla"){
    header("Location: pass_form.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' type='text/css' href='../style/main.css'/>
    <title><?php echo $title ?></title>
</head>

<body>
    <header>
        <div class="nav">
            <ul>
                <li class="visits"><a <?php if($title == 'Kalendář') echo 'class="active"'?> href="calendar.php">Kalendář</a></li>
                <li class="patients"><a <?php if($title == 'Pacienti') echo 'class="active"'?> href="pacients.php">Pacienti</a></li>
                <li class="drugs"><a <?php if($title == 'Léky') echo 'class="active"'?> href="drugs.php">Léky</a></li>
                <li class="insurance"><a <?php if($title == 'Pojišťovny') echo 'class="active"'?> href="insurance.php">Pojišťovny</a></li>
                <li class="bills"><a <?php if($title == 'Faktury') echo 'class="active"'?> href="bills.php">Faktury</a></li>
                <li class="employee"><a <?php if($title == 'Zaměstnanci') echo 'class="active"'?> href="employee.php">Zaměstnanci</a></li>
                <li class="user">
                    <img id="userimg" src="../style/user.png" width="20" height="20"/>
                    <?php echo"<a id=\"username\">".$user->name."</a>"?>
                    <ul id="submenu">
                        <a class="submenu_item" href="#">Změna hesla</a>
                        <a class="submenu_item" href="#">Odhlášení</a>
                    </ul>
                </li>
            </ul>
        </div>
    </header>
