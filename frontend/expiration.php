<?php
session_start();
$title = "Expirace";
require_once("../backend/examination.php");
include "header.php";
?>
    <div class="site">
        <div class="content">
<!--            <h1>Expirace výkonu</h1>-->
<!--            <select>-->
<!--                --><?php
//                $examinations = get_examinations();
//                foreach ($examinations as $row) {
//                    echo "<option value=".$row["name"].">".$row["name"]."</option>";
//                }
//                ?>
<!--            </select>-->
            <h1>Expirace tento měsíc</h1>
            <table>
                <tr>
                    <th>Příjmení</th>
                    <th>Jméno</th>
                    <th>Výkon</th>
                    <th>Zaslat pozvánku</th>
                </tr>
                <?php
                $pacients = get_examination_expirations();
                foreach ($pacients as $row) {
                    $add = $row["email"];
                    $ex = $row["exam"];
                    echo "<tr class=\"patient_row\" onclick=\"window.document.location='pacient.php?id=".$row["id"]."';\">";
                    echo "<td>".$row["surname"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["exam"]."</td>";
                    echo "<td>
                             <form action=\"mailto.php\" method=\"post\">
                                    <input type=\"hidden\" name=\"address\" value=\"$add\">
                                    <input type=\"hidden\" name=\"exam\" value=\"$ex\">
                                    <button type=\"submit\">Poslat mail</button>
                              </form>
                          </td>";
                    echo "</tr>";
                }
                ?>
            </table>
        </div>
    </div>
<?php
include "footer.php";
?>