<?php
session_start();
$title = "Faktury";
include "header.php";
?>
    <div class="site">
        <div class="content">
            <h4>Poslat mail: <?php echo $_POST["address"];?></h4>
            <hr/>
            <form action="../backend/save/send_mail_to.php" method="post">
                <div>
                    <div><b>Predmet</b></div>
                    <input name="subject" type="text" placeholder="Předmet" required>
                </div>
                <div>
                    <div><b>Správa</b></div>
                    <textarea rows="10" cols="70" name="message" maxlength="2048" placeholder="Správa" required></textarea>
                </div>
                <div>
                    <input type="hidden" name="address" value="<?php echo $_POST["address"];?>">
                    <button type="submit" >Odeslat</button>
                </div>
            </form>
        </div>
    </div>
<?php
include "footer.php";
?>