<?php
session_start();
$title = "Pacienti";
include "header.php";
require_once ("../backend/patient.php");
require_once ("../backend/insurance.php");
if (!isset($_SESSION['psaved'])){
    echo '<script>
        $(document).ready(function(){
            $("add_form").hide();           // hide on start
            $("add_patient").click(function(){       // listen for click
                $("add_form").toggle("fast");     // toggle when clicked
            });
        });
    </script>';
}
?>

    <div class="site">
        <div class="content">
            <div>
                <h1>Pacienti</h1>
                <add_patient>
                    <button class="add_new">Přidat nového pacienta</button>
                </add_patient>
            </div>
            <add_form>
                <h4>Nový pacient</h4>
                <hr/>
                <form action="../backend/save/pacient_add.php" method="post">
                    <div id="form-labels">
                        <div class="form-label"><b>*Jméno:</b></div>
                        <div class="form-label"><b>*Příjmení:</b></div>
                        <div class="form-label"><b>*Rodné číslo:</b></div>
                        <div class="form-label"><b>*Číslo pojišťovny:</b></div>
                        <div class="form-label"><b>*Ulice:</b></div>
                        <div class="form-label"><b>*Číslo popisné:</b></div>
                        <div class="form-label"><b>*Město:</b></div>
                        <div class="form-label"><b>*PSČ:</b></div>
                        <div class="form-label"><b>*Mail:</b></div>
                        <div class="form-label"><small>Položky s * jsou povinné</small></div>
                    </div>
                    <div id="forms">
                        <div><input class="left_input" type="text" name="fname" value="<?php echo htmlspecialchars($_SESSION['psaved']['fname']); ?>" required></div>
                        <div><input class="left_input" type="text" name="surname" value="<?php echo htmlspecialchars($_SESSION['psaved']['surname']); ?>" required></div>
                        <div><input class="left_input" type="text" name="rc" value="<?php echo htmlspecialchars($_SESSION['psaved']['rc']); ?>" required></div>
                        <div>
                            <select class="left_input" name="insurance">
                                <?php
                                $insurance = get_insurance_comps();
                                foreach ($insurance as $row) {
                                    if (isset($_SESSION['psaved']['insurance']) && $_SESSION['psaved']['insurance'] === $row["id"])
                                            echo "<option selected=\"selected\" value=".$row["id"].">".$row["name"]."</option>";
                                    else
                                        echo "<option value=".$row["id"].">".$row["name"]."</option>";
                                }
                                ?>
                            </select>
                        </div>
                        <div><input class="left_input" type="text" name="street" value="<?php echo htmlspecialchars($_SESSION['psaved']['street']); ?>" required></div>
                        <div><input class="left_input" type="text" name="str_number" value="<?php echo htmlspecialchars($_SESSION['psaved']['str_number']); ?>" required></div>
                        <div><input class="left_input" type="text" name="city" value="<?php echo htmlspecialchars($_SESSION['psaved']['city']); ?>" required></div>
                        <div><input class="left_input" type="number" name="postal_code" min="0" value="<?php echo htmlspecialchars($_SESSION['psaved']['postal_code']);?>" required></div>
                        <div><input class="left_input" type="email" name="mail" value="<?php echo htmlspecialchars($_SESSION['psaved']['mail']);?>" required></div>
                        <button id="save₋10" type="submit">Uložit</button>
                    </div>
                </form>
            </add_form>
            <table>
                <tr>
                    <th>Příjmení</th>
                    <th>Jméno</th>
                    <th>Rodné číslo</th>
                    <th>Kontakt</th>
                </tr>
                <?php
                $pacients = get_patients();
                foreach ($pacients as $row) {
                    $add = $row["mail"];
                    echo "<tr class=\"patient_row\" onclick=\"window.document.location='pacient.php?id=".$row["id"]."';\">";
                    echo "<td>".$row["surname"]."</td>";
                    echo "<td>".$row["fname"]."</td>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>
                             <form action=\"mailto.php\" method=\"post\">
                                    <input type=\"hidden\" name=\"address\" value=\"$add\">
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