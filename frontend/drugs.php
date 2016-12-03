<?php
session_start();
$title = "Léky";
require_once("../backend/drugs.php");
include "header.php";
?>
<div class="site">
    <div class="content">
        <script>
            $(document).ready(function(){
                $("add_form").hide();           // hide on start
                $("button").click(function(){       // listen for click
                    $("add_form").toggle("fast");     // toggle when clicked
                });
            });
        </script>
        <div>
            <h1>Léky</h1>
            <button class="add_new">Přidat lék</button>
        </div>
        <add_form>
            <h4>Přidat lék</h4>
            <hr/>
            <form action="../backend/save/drug_add.php" method="post">
                <div id="form-labels">
                    <div class="form-label"><b>*Název:</b></div>
                    <div class="form-label"><b>*Typ:</b></div>
                    <div class="form-label"><b>*Popis:</b></div>
                    <div class="form-label"><small>Položky s * jsou povinné</small></div>
                </div>
                <div id="forms">
                    <input class="left_input" type="text" name="name" required>
                    <input class="left_input" type="text" name="drug_type" required>
                    <input class="left_input" type="text" name="description" required>
                    <div>
                        <button id="save₋11" type="submit">Uložit</button>
                    </div>
                </div>
            </form>
        </add_form>
        <table>
            <tr>
                <th>Jméno</th>
                <th>Typ</th>
                <th>Popis</th>
                <th>Odstranit</th>
            </tr>
            <?php
            $drugs = get_drugs();
            foreach ($drugs as $row) {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["drug_type"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo '<td>
                      <form action="../backend/save/drug_remove.php" method="post">
                        <input name="delete_id" type="hidden" value='.$row["id_drug"].'>
                        <button onclick="return confirm(\'Opravdu chcete smazat záznam o léku? Tento lék bude smazán ze všech záznamů pacientů!\')">SMAZAT</button>
                      </form>
                      </td>
                 ';
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php
include "footer.php";
?>