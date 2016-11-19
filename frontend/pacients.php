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
        </div>
    </div>
<?php
include "footer.php";
?>