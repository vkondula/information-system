<?php
session_start();
$title = "Kalendář";
require_once("../backend/calendar.php");
include "header.php";
?>
<div class="site">
    <div class="content">
        <script>
            $(document).ready(function(){
                $("add_form").hide();
                $("add_form").toggle("fast");     // toggle when clicked
            });
        </script>
        <h1>Seznam návštev</h1>
        <?php
            $date_ymd = $_GET["date"];
            if (empty($date_ymd)) $date_ymd = date("Y-m-d");
            $mtgs = get_mtgs($date_ymd);
        ?>
        <form action="calendar.php" method="get">
            <h3 align="center">Výběr dne</h3>
            <div align="center">
                <input class="center_blue_input" type="date" name="date" value="<?php echo $date_ymd; ?>" required>
                <button id="show_2" type="submit">Zobraz</button>
            </div>
        </form>
        <add_form>
            <?php
            if (sizeof($mtgs) !== 0) {
                echo '<table>
                            <tr>
                                <th>Datum a Čas</th>
                                <th>Příjmení</th>
                                <th>Jméno</th>
                                <th>Rodné číslo</th>
                            </tr>';
                foreach ($mtgs as $row) {
                    echo "<tr class=\"patient_row\" onclick=\"window.document.location='pacient.php?id=" . $row["id_pat"] . "&v=" . $row["id_v"] . "';\">";
                    echo "<td>" . $row["m_date"] . "</td>";
                    echo "<td>" . $row["surname"] . "</td>";
                    echo "<td>" . $row["fname"] . "</td>";
                    echo "<td>" . $row["id_pat"] . "</td>";
                    echo "</tr>";
                }
                echo '</table>';
            }
            else {
                echo "<h2>Žádna návšteva pro uvedené období</h2>";
            }
            ?>
        </add_form>
    </div>
</div>
<?php
include "footer.php";
?>
