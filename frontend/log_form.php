<!DOCTYPE html>
<html>
<head>
    <meta charset='UTF-8'>
    <link rel='stylesheet' type='text/css' href='../style/main.css'/>
    <title>Prihlásenie</title>
    <header>
        Prihlásenie
    </header>
</head>

<body>
<form action="../backend/log_page.php" method="post">
    <div class="container">
        <div class="center">
            <label><b>Email</b></label>
        </div>
        <div class="center">
            <input type="text" placeholder="Enter Email" name="email" required>
        </div>
        <div class="center">
            <label><b>Password</b></label>
        </div>
        <div class="center">
            <input type="password" placeholder="Enter Password" name="password" required>
        </div>
        <div class="center">
            <button class="loginbtn" type="submit">Login</button>
        </div>
    </div>
</form>
</body>
<footer>
    created for ISS 2016 ©
    <a href="mailto:vkondula@gmail.com"> vkondula@gmail.com</a>
    <a href="mailto:krajnakmatto@gmail.com"> krajnakmatto@gmail.com</a>
</footer>
