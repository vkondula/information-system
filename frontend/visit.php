<?php
require_once("../backend/patient.php");
function print_visit_info($v, $p){
    $v_info = get_visit_info($v)[0];
    $v_date = DateTime::createFromFormat('Y-m-d H:i:s', $v_info["datetime"]);
?>
<div class='rightcontent'>
    <div>
        <form action="../backend/save/visit_date.php" method="post">
            <div>
                <div class="left">
                    <div id="form-labels">
                        <div class="form-label"><b>Datum:</b></div>
                    </div>
                    <div id="forms">
                        <div><input class="left_input" type="date" name="date" required value="<?php echo $v_date->format("Y-m-d"); ?>"></div>
                    </div>
                </div>
                <div class="right">
                    <div id="form-labels">
                        <div class="form-label"><b>Čas:</b></div>
                    </div>
                    <div id="forms">
                        <div><input class="left_input" type="time" name="time" required value="<?php echo $v_date->format("H:i:s"); ?>"></div>
                    </div>
                </div>
            </div>
            <div class="cell_center">
                <input type="hidden" name="id_v" value="<?php echo $v; ?>">
                <input type="hidden" name="id_p" value="<?php echo $p; ?>">
                <button id="save₋1" type="submit">Uložit</button>
            </div>
        </form>
    </div>
    <hr/>
    <div class="cell_center">
        <h1>Zpráva</h1>
        <textarea rows="10" cols="70" name="comment" form="report_form" maxlength="1023"><?php echo $v_info["report"]; ?></textarea>
        <form action="../backend/save/visit_report.php" method="post" id="report_form">
            <div>
                <input type="hidden" name="id_v" value="<?php echo $v; ?>">
                <input type="hidden" name="id_p" value="<?php echo $p; ?>">
                <button id="save₋2" type="submit">Uložit</button>
            </div>
        </form>
    </div>
    <hr/>
    <div class="cell_center">
        <h1>Léky</h1>
        <?php
        if (whois_logged()->is_doctor())
            drug_form($v);
        $drugs = prescribed_drugs($v);
        if (!empty($drugs)){
            drug_print($drugs, $v, $p);
        }

        if (whois_logged()->is_doctor())
            drug_form($v, $p);
        ?>
    </div>
    <hr/>
    <div class="cell_center">
        <h1>Faktura</h1>
        <?php
        $bills = get_bill($v);
        if (!empty($bills)){
            bill_print($bills, $v, $p);
        }
        bill_form($v, $p);
        ?>
    </div>
    <div align="right">
        <form action="../backend/save/visit_remove.php" method="post">
            <input type="hidden" name="id_p" value="<?php echo $p; ?>">
            <input type="hidden" name="id_v" value="<?php echo $v; ?>">
            <button class="red_button" id="save₋0" type="submit" onclick="return confirm('Opravdu chcete smazat všechny informace o navštěvě? Tato akce je nevratná.')">Smazat návštěvu</button>
        </form>
    </div>
</div>
<?php
}

function bill_print($bills, $v, $p){
    echo '<table>
        <tr>
            <th>Datum splatnosti</th>
            <th>Cena</th>
            <th>Doplatek</th>
            <th>Odstranit</th>
        </tr>';
    foreach ($bills as $bill) {
        echo "<tr>";
        echo "<td>" . $bill["b_date"] . "</td>";
        echo "<td>" . $bill["price"] . "</td>";
        echo "<td>" . $bill["extra"] . "</td>";
        echo '
           <td>
              <form action="../backend/save/visit_remove_bill.php"" method="post">
                <input name="id_bill" type="hidden" value=' . $bill["id_bill"] . '>
                <input type="hidden" name="id_v" value="'.$v.'">
                <input type="hidden" name="id_p" value="'.$p.'">
                <button onclick="return confirm(\'Opravdu chcete smazat záznam?\')">SMAZAT</button>
              </form>
          </td>';
        echo "</tr>";
    }
    echo '</table>';
}

function bill_form($v, $p){
?>

    <script>
        $(document).ready(function(){
            $("add_bill").hide();           // hide on start
            $("bill_button").click(function(){       // listen for click
                $("add_bill").toggle("fast");     // toggle when clicked
            });
        });
    </script>
    <div>
        <bill_button type="button">
            <button>Přidat fakturu</button>
        </bill_button>
     </div>
    <add_bill>
        <h2>Nová faktura</h2>
        <hr/>
        <form action="../backend/save/visit_add_bill.php" method="post">
            <div>
                <label><b>Datum:</b></label>
            </div>
            <div>
                <input type="date" name="date" required value="<?php echo date("Y-m-d"); ?>">
            </div>
            </br>
            <div>
                <label><b>Cena:</b></label>
            </div>
            <div>
                <input type="number" name="price" min="0" required value=0">
            </div>
            </br>
            <div>
                <label><b>Doplatek:</b></label>
            </div>
            <div>
                <input type="number" name="extra" min="0" required value=0">
            </div>
            <div>
                <input type="hidden" name="id_v" value="<?php echo $v; ?>">
                <button id="save₋3" type="submit">Uložit</button>
            </div>
        </form>
    </add_bill>
<?php
}

function drug_print($drugs, $v, $p){
    echo '<table>
        <tr>
            <th>Název</th>
            <th>Druh</th>
            <th>Počet balení</th>
            <th>Odstranit</th>
        </tr>';
    foreach ($drugs as $row){
        echo "<tr>";
        echo "<td>".$row["name"]."</td>";
        echo "<td>".$row["drug_type"]."</td>";
        echo "<td>".$row["drug_count"]."</td>";
        echo '<td>
                  <form action="../backend/save/visit_remove_drug.php" method="post">
                    <input name="id_term" type="hidden" value='.$row["id_term"].'>
                    <input name="id_drug" type="hidden" value='.$row["id_drug"].'>
                    <input type="hidden" name="id_v" value="'.$v.'">
                    <input type="hidden" name="id_p" value="'.$p.'">
                    <button onclick="return confirm(\'Opravdu chcete smazat záznam ?\')">SMAZAT</button>
                  </form>
              </td>';
        echo "</tr>";
    }
    echo "</table>";
}

function drug_form($v, $p){
    ?>
    <script>
        $(document).ready(function(){
            $("add_drug").hide();           // hide on start
            $("drug_button").click(function(){       // listen for click
                $("add_drug").toggle("fast");     // toggle when clicked
            });
        });
    </script>
    <div>
        <drug_button>
            <button class="add_new">Předepsat lék</button>
        </drug_button>
    </div>
    <add_drug>
        <h2>Předepsat lék</h2>
        <hr/>
        <form action="../backend/save/visit_add_drug.php" method="post">
            <div>
                <label><b>Lék:</b></label>
            </div>
            <div>
                <input type="text" placeholder="Název léku" name="name" required>
            </div>
            </br>
            <div>
                <label><b>Počet balení:</b></label>
            </div>
            <div>
                <input type="number" name="number" min="1" required value="1">
            </div>
            </br>
            <div>
                <input type="hidden" name="id_v" value="<?php echo $v; ?>">
                <button id="save₋4" type="submit">Uložit</button>
            </div>
        </form>
    </add_drug>
<?php
}
?>