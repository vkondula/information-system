<?php
session_start();
$title = "Pacienti";
include "header.php";
require_once ("../backend/patient.php");
?>
    <div class="site">
        <div class="content">
            <h1>Pacienti</h1>
            <table>
                <tr>
                    <th>Příjmení</th>
                    <th>Jméno</th>
                    <th>Rodné číslo</th>
                </tr>
                <?php
                $pacients = get_patients();
                foreach ($pacients as $row) {
                    echo "<tr onclick=\"window.document.location='pacient.php?id=".$row["id"]."';\">";
                    echo "<td>".$row["surname"]."</td>";
                    echo "<td>".$row["fname"]."</td>";
                    echo "<td>".$row["id"]."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
            <div>
                <h4>Nový pacient</h4>
                <form action="../backend/save/pacient_add.php" method="post">
                    <div>
                        <label><b>Jméno:</b></label>
                        <input class="left_input" type="text" name="fname" required>
                    </div>
                    <div>
                        <label><b>Příjmení:</b></label>
                        <input class="left_input" type="text" name="surname" required>
                    </div>
                    <div>
                        <label><b>Rodné číslo:</b></label>
                        <input class="left_input" type="text" name="rc" required>
                    </div>
                    <div>
                        <label><b>Číslo pojišťovny:</b></label>
                        <input class="left_input" type="number" name="insurance" min="0" required>
                    </div>
                    <div>
                        <label><b>Ulice:</b></label>
                        <input class="left_input" type="text" name="street" required>
                    </div>

                    <div>
                        <label><b>Číslo popisné:</b></label>
                        <input class="left_input" type="text" name="str_number" required>
                    </div>
                    <div>
                        <label><b>Město:</b></label>
                        <input class="left_input" type="text" name="city" required>
                    </div>
                    <div>
                        <label><b>PSČ:</b></label>
                        <input class="left_input" type="number" name="postal_code" min="0" required>
                    </div>
                    <div>
                        <button id="save₋10" type="submit">Uložit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php
include "footer.php";
?>