<?php
/**
 * Created by PhpStorm.
 * User: mkrajnak
 * Date: 11/22/16
 * Time: 3:41 PM
 */
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
                        <input class="left_input" type="number" name="number" min="1" required value="1">
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
                </tr>
                <?php
                $examinations = get_examinations();
                foreach ($examinations as $row) {
                    echo "<tr>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["expiration"]."</td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
<?php
include "footer.php";
?>