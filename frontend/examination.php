<?php
session_start();
$title = "Výkony";
require_once("../backend/examination.php");
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
                <h1>Výkony</h1>
                <button class="add_new">Přidat výkon</button>
            </div>
            <add_form>
                <h4>Přidat nový výkon</h4>
                <hr/>
                <form action="../backend/save/examination_add.php" method="post">
                    <div id="form-labels">
                        <div class="form-label"><b>Název:</b></div>
                        <div class="form-label"><b>Expirace:</b></div>
                    </div>
                    <div id="forms">
                        <input class="left_input" type="text" name="name" required>
                        <input class="left_input" type="number" name="number" min="1" placeholder="počet dní">
                        <div>
                            <button id="save₋11" type="submit">Uložit</button>
                        </div>
                    </div>
                </form>
            </add_form>
            <table>
                <tr>
                    <th>Jméno</th>
                    <th>Expirace</th>
                    <th>Odstranit</th>
                </tr>
                <?php
                $examinations = get_examinations();
                foreach ($examinations as $row) {
                    echo "<tr>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["expiration"]."</td>";
                    echo '<td>
                      <form action="../backend/save/examination_remove.php" method="post">
                        <input name="delete_id" type="hidden" value='.$row["id"].'>
                        <button onclick="return confirm(\'Opravdu chcete smazat záznam o výkonu? Tento výkon bude smazán ze všech záznamů pacientů!\')">SMAZAT</button>
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