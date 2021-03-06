<?php
session_start();
$title = "Faktury";
require_once("../backend/bills.php");
include "header.php";
?>
<div class="site">
    <div class="content">
        <script>
            $(document).ready(function(){
                $("add_form").hide();
                $("add_form").slideDown("slow");     // toggle when clicked
            });
        </script>
        <h1>Faktury</h1>
        <?php
            $month = $_GET["date"];
            if (empty($month)) $month = date("Y-m");
            $bills = get_bills($month);
        ?>
        <form action="bills.php" method="get">
            <h3 align="center">Výběr měsíce</h3>
            <div align="center">
                <input class="center_blue_input" type="month" name="date" value="<?php echo date("Y-m"); ?>" required>
                <button id="show_1" type="submit">Zobraz</button>
            </div>
        </form>
        <add_form>
            <?php
                if (sizeof($bills) !== 0){
                    echo '<table>
                        <tr>
                            <th>Datum splatnosti</th>
                            <th>Částka (Kč)</th>
                            <th>Doplatek (Kč)</th>
                            <th>Číslo pojišťovny</th>
                            <th>Rodné číslo</th>
                        </tr>';

                    foreach ($bills as $bill){
                        echo "<tr>";
                        echo "<td>" . $bill["b_date"] . "</td>";
                        echo "<td>" . $bill["price"] . "</td>";
                        echo "<td>" . $bill["extra"] . "</td>";
                        echo "<td>" . $bill["id_ins"] . "</td>";
                        echo "<td>" . $bill["id_pat"] . "</td>";
                        echo "</tr>";
                    }
                    echo '</table>';
                    echo '<button onclick="window.print()">Tisk</button>' ;
                }
                else{
                    echo "<h2>Žádne záznamy pro uvedené období</h2>";
                }
            ?>
        </add_form>
    </div>
</div>
<?php
include "footer.php";
?>