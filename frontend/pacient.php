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
            <hr/>
            <?php
            $visits = get_all_visits($id);
            foreach ($visits as $v){
                // TODO: naformatovat
                echo "<div>";
                echo "<a href='pacient.php?id=".$id."&v=".$v["id"]."' >";
                echo $v["datetime"];
                echo "</a>";
                echo "</div>";
                echo "<hr/>";
            }
            ?>
        </div>
        <div class="rightcontent">
            <div>
                <form action="../backend/save/pacient_change.php" method="post" id="pac_form">
                    <div>
                        <input class="center_input" placeholder="Jméno" type="text" name="fname" required value="<?php echo $patient["name"]; ?>">
                        <input class="center_input" placeholder="Příjmení" type="text" name="surname" required value="<?php echo $patient["surname"]; ?>">
                    </div>
                    </br>
                    <div>
                        <div style="width: 50%; float:left" >
                            <label><b>Rodné číslo:</b></label>
                            <input class="left_input" type="text" name="rc" required value="<?php echo $patient["rc"]; ?>">
                        </div>

                        <div style="width: 50%; float:right">
                            <label><b>Číslo pojišťovny:</b></label>
                            <input class="left_input" type="number" name="insurance" min="0" required value="<?php echo $patient["insurance"]; ?>" style="width:100px">
                        </div>
                        </br style="clear:both;">
                    </div>
                    </br>
                    <hr/>
                    <h3>Trvalé bydliště</h3>
                    <div>
                        <div style="width: 50%; float:left" >
                            <div>
                                <label><b>Ulice:</b></label>
                                <input class="left_input" type="text" name="street" required value="<?php echo $patient["street"]; ?>">
                            </div>

                            <div>
                                <label><b>Číslo popisné:</b></label>
                                <input class="left_input" type="text" name="str_number" required value="<?php echo $patient["str_number"]; ?>" style="width:100px">
                            </div>
                        </div>
                        <div style="width: 50%; float:right">
                            <div>
                                <label><b>Město:</b></label>
                                <input class="left_input" type="text" name="city" required value="<?php echo $patient["city"]; ?>">
                            </div>
                            <div>
                                <label><b>PSČ:</b></label>
                                <input class="left_input" type="number" name="postal_code" min="0" required value="<?php echo $patient["postal_code"]; ?>">
                            </div>
                        </div>
                        </br style="clear:both;">
                    </div>
                </form>
                <div>
                    <div style="width: 50%; float:left" >
                        <button form="pac_form" id="save₋8" type="submit">Uložit</button>
                    </div>
                    <div style="width: 50%; float:right" align="right">
                        <form action="../backend/pacient_remove.php" method="post">
                            <input type="hidden" name="id_p" value="<?php echo $patient["rc"]; ?>">
                            <button class="red_button" id="remove₋0" type="submit" onclick="return confirm('Opravdu chcete smazat všechny informace o pacientovi? Tato akce je nevratná.')">Smazat pacienta</button>
                        </form>
                    </div>
                    </br style="clear:both;">
                </div>
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