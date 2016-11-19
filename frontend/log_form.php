<?php
session_start();
unset($_SESSION["login_user"]);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' type='text/css' href='../style/main.css'/>
    <title>Přihlášení</title>
    <header>
        <div id="loginheader">Přihlášení</div>
    </header>
</head>

<body>
<?php
if (!empty($_SESSION["error"])){
    echo "<div id=\"error\"><b>".$_SESSION["error"]."</b></div>";
    unset($_SESSION["error"]);
}
?>
<form action="../backend/log_page.php" method="post">
    <div class="container">
        <div class="center">
            <label><b>Email</b></label>
        </div>
        <div class="center">
            <input type="text" class="center_input" placeholder="Enter Email" name="email" required>
        </div>
        <div class="center">
            <label><b>Password</b></label>
        </div>
        <div class="center">
            <input type="password" class="center_input" placeholder="Enter Password" name="password">
        </div>
        <div class="center">
            <button id="loginbtn" type="submit">Login</button>
        </div>
    </div>
</form>
<?php
include "footer.php";
?>
