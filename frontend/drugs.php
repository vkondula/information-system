<?php
session_start();
$title = "Léky";
require_once("../backend/drugs.php");
include "header.php";
?>
<div class="site">
    <div class="content">
        <h1>Léky</h1>
        <table>
            <tr>
                <th>Jméno</th>
                <th>Typ</th>
                <th>Popis</th>
            </tr>
            <?php
            $drugs = get_drugs();
            foreach ($drugs as $row) {
                echo "<tr>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["drug_type"]."</td>";
                echo "<td>".$row["description"]."</td>";
                echo "</tr>";
            }
            ?>
        </table>
        <div>
            <h4>Přidat lék</h4>
            <form action="../backend/save/drug_add.php" method="post">
                <div>
                    <label><b>Název:</b></label>
                    <input class="left_input" type="text" name="name" required>
                </div>
                <div>
                    <label><b>Typ:</b></label>
                    <input class="left_input" type="text" name="drug_type" required>
                </div>
                <div>
                    <label><b>Popis:</b></label>
                    <input class="left_input" type="text" name="description" required>
                </div>
                <div>
                    <button id="save₋11" type="submit">Uložit</button>
                </div>
            </form>
        </div>
    </div>
</div>
<?php
include "footer.php";
?>