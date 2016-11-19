<?php
session_start();
$title = "Změna hesla";
include "header.php";
?>
<div class="site">
    <div class="content">
        <h1>Změna hesla</h1>
        <form action="../backend/set_pass_page.php" method="post">
            <div class="container">
                <label><b>Zadejte heslo:</b></label>
                <input class="center_blue_input" type="password" placeholder="Password" name="password1" required>
                <br/>
                <label><b>Opakujte heslo:</b></label>
                <input class="center_blue_input" type="password" placeholder="Repeat Password" name="password2" required>

                <button type="submit">Nastavit</button>
            </div>
        </form>
    </div>
</div>
<?php
include "footer.php";
?>