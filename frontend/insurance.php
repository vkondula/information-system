<?php
session_start();
$title = "Pojišťovny";
include "header.php";
require_once ("../backend/insurance.php");
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
            <h1>Pojišťovny</h1>
            <button class="add_new">Přidat Pojišťovnu</button>
        </div>
        <add_form>
            <h4>Přidat Pojišťovnu</h4>
            <hr/>
            <form action="../backend/save/insurance_add.php" method="post">
                <div id="form-labels">
                    <div class="form-label"><b>*Číslo:</b></div>
                    <div class="form-label"><b>*Název:</b></div>
                    <div class="form-label"><small>Položky s * jsou povinné</small></div>
                </div>
                <div id="forms">
                    <input class="left_input" type="number" min="0" name="id_ins" required>
                    <input class="left_input" type="text" name="name" required>
                    <div>
                        <button id="save₋12" type="submit">Uložit</button>
                    </div>
                </div>
            </form>
        </add_form>

        <table>
           <tr>
                <th>Číslo</th>
                <th>Název</th>
                <th>Počet klientů</th>
                <th>Odstranit</th>
            </tr>
            <?php
            $insurance_comps = get_insurance_comps();
            foreach ($insurance_comps as $row) {
                echo "<tr>";
                echo "<td>".$row["id"]."</td>";
                echo "<td>".$row["name"]."</td>";
                echo "<td>".$row["count"]."</td>";
                if ($row["count"] == 0){
                    echo '<td>
                      <form action="../backend/remove_insur.php" method="post">
                        <input name="delete_id" type="hidden" value='.$row["id"].'>
                        <button onclick="return confirm(\'Opravdu chcete smazat záznam o pojišťovně?\')">SMAZAT</button>
                      </form>
                      </td>
                 ';
                } else {
                    echo "<td></td>";
                }
                echo "</tr>";
            }
            ?>
        </table>
    </div>
</div>
<?php
include "footer.php";
?>