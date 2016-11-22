<?php
session_start();
$title = "Pacienti";
$id = $_GET["id"];
require_once ("../backend/patient.php");
require_once ("visit.php");
if(empty($id)) header("Location: pacients.php");
$patients = get_patient_info($id);
if (count($patients) == 0) header("Location: pacients.php");
$patient = $patients[0];
include "header.php";
?>
    <div class="site">

        <div class="sidepanel" >
            <form action="../backend/save/visit_new.php" method="post">
                <input type="hidden" name="id_p" value="<?php echo $patient["rc"]; ?>">
                <button id="save₋0" type="submit">Nová návšteva</button>
            </form>
            <h4>Návštevy pacienta</h4>
            <hr/>
            <table>
                <tr>
                    <th id="apointment_header">Dátum a Čas</th>
                </tr>
            <?php
            $visits = get_all_visits($id);
            foreach ($visits as $v){
                echo "<tr class=\"patient_row\" >";
                echo "<td class=\"cell_center\">";
                echo "<a class=\"apointment\" href='pacient.php?id=".$id."&v=".$v["id"]."' >";
                echo $v["datetime"];
                echo "</a>";
                echo "</td></tr>";
            }
            ?>
            </table>
        </div>
        <div class="rightcontent">
            <div>
                <form action="../backend/save/pacient_change.php" method="post" id="pac_form">
                    <input type="hidden" name="id_p" value="<?php echo $patient["rc"]; ?>">
                    <div>
                        <input class="center_input" placeholder="Jméno" type="text" name="fname" required value="<?php echo $patient["name"]; ?>">
                        <input class="center_input" placeholder="Příjmení" type="text" name="surname" required value="<?php echo $patient["surname"]; ?>">
                    </div>
                    <h4>Trvalé bydliště</h4>
                    <div>
                        <div class="left">
                            <div id="form-labels">
                                <div class="form-label"><b>Ulice:</b></div>
                                <div class="form-label"><b>Číslo popisné:</b></div>
                                <div class="form-label"><b>Město:</b></div>
                                <div class="form-label"><b>PSČ:</b></div>
                            </div>
                            <div id="forms">
                                <div><input class="left_input" type="text" name="street" required value="<?php echo $patient["street"]; ?>"></div>
                                <div><input class="left_input" type="text" name="str_number" required value="<?php echo $patient["str_number"]; ?>"></div>
                                <div><input class="left_input" type="text" name="city" required value="<?php echo $patient["city"]; ?>"></div>
                                <div><input class="left_input" type="number" name="postal_code" min="0" required value="<?php echo $patient["postal_code"]; ?>"></div>
                            </div>
                        </div>
                        <div class="right">
                            <div id="form-labels">
                                <div class="form-label"><b>Rodné číslo:</b></div>
                                <div class="form-label"><b>Číslo pojišťovny:</b></div>
                            </div>
                            <div id="forms">
                                <div><input class="left_input" type="text" name="rc" required value="<?php echo $patient["rc"]; ?>"></div>
                                <div><input class="left_input" type="number" name="insurance" min="0" required value="<?php echo $patient["insurance"]; ?>"></div>
                            </div>
                        </div>
                    </div>
                    <button form="pac_form" id="save₋8" type="submit">Uložit změny</button>
                </form>
                <form action="../backend/pacient_remove.php" method="post">
                    <input type="hidden" name="id_p" value="<?php echo $patient["rc"]; ?>">
                    <button class="red_button" id="remove₋0" type="submit" onclick="return confirm('Opravdu chcete smazat všechny informace o pacientovi? Tato akce je nevratná.')">Smazat pacienta</button>
                </form>
            </div>
        </div>
            <?php
                $visit = get_last_visit($patient["rc"]);
                if(!empty($_GET["v"])) $visit = $_GET["v"];
                if(!empty($visit)){
                    print_visit_info($visit, $patient["rc"]);
                }
            ?>
    </div>
<?php
include "footer.php";
?>