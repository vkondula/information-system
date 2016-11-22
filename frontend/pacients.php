<?php
session_start();
$title = "Pacienti";
include "header.php";
require_once ("../backend/patient.php");
?>
    <script>
        $(document).ready(function(){
            $("add_form").hide();           // hide on start
            $("button").click(function(){       // listen for click
                $("add_form").toggle("fast");     // toggle when clicked
            });
        });
    </script>
    <div class="site">
        <div class="content">
            <div>
                <h1>Pacienti</h1>
                <button class="add_new">Přidat nového pacienta</button>
            </div>
            <add_form>
                <h4>Nový pacient</h4>
                <hr/>
                <form action="../backend/save/pacient_add.php" method="post">
                    <div id="form-labels">
                        <div class="form-label"><b>Jméno:</b></div>
                        <div class="form-label"><b>Příjmení:</b></div>
                        <div class="form-label"><b>Rodné číslo:</b></div>
                        <div class="form-label"><b>Číslo pojišťovny:</b></div>
                        <div class="form-label"><b>Ulice:</b></div>
                        <div class="form-label"><b>Číslo popisné:</b></div>
                        <div class="form-label"><b>Město:</b></div>
                        <div class="form-label"><b>PSČ:</b></div>
                    </div>
                    <div id="forms">
                        <div><input class="left_input" type="text" name="fname" required></div>
                        <div><input class="left_input" type="text" name="surname" required></div>
                        <div><input class="left_input" type="text" name="rc" required></div>
                        <div><input class="left_input" type="number" name="insurance" min="0" required></div>
                        <div><input class="left_input" type="text" name="street" required></div>
                        <div><input class="left_input" type="text" name="str_number" required></div>
                        <div><input class="left_input" type="text" name="city" required></div>
                        <div><input class="left_input" type="number" name="postal_code" min="0" required></div>
                        <button id="save₋10" type="submit">Uložit</button>
                    </div>
                </form>
            </add_form>
            <table>
                <tr>
                    <th>Příjmení</th>
                    <th>Jméno</th>
                    <th>Rodné číslo</th>
                </tr>
                <?php
                $pacients = get_patients();
                foreach ($pacients as $row) {
                    echo "<tr class=\"patient_row\" onclick=\"window.document.location='pacient.php?id=".$row["id"]."';\">";
                    echo "<td>".$row["surname"]."</td>";
                    echo "<td>".$row["fname"]."</td>";
                    echo "<td>".$row["id"]."</td>";
                    echo "</tr>";
                }
                ?>

            </table>
        </div>
    </div>
<?php
include "footer.php";
?>