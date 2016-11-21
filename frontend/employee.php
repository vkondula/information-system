<?php
session_start();
$title = "Zaměstnanci";
include "header.php";
require_once("../backend/person.php");
require_once("../backend/employees.php");
$doc = whois_logged()->is_doctor();
?>
<div class="site">
    <div class="content">
        <h1>Zaměstnanci</h1>
        <?php
        if($doc){
            ?>
            <div>
                <button class="add_new">Přidat nového zaměstnance</button>
            </div>
            <add_form>
                <h4>Nový zaměstnanec</h4>
                <hr/>
                <form action="../backend/save/emloyee_add.php" method="post">
                    <div id="form-labels">
                        <div class="form-label"><b>Jméno:</b></div>
                        <div class="form-label"><b>Příjmení:</b></div>
                        <div class="form-label"><b>Email:</b></div>
                        <div class="form-label"><b>Zařazení:</b></div>
                    </div>
                    <div id="forms">
                        <input class="left_input" type="text" name="fname" required>
                        <input class="left_input" type="text" name="surname" required>
                        <input class="left_input" type="text" name="email" required>
                        <div>
                            <select name="doctor">
                                <option value="1">Doktor</option>
                                <option value="0">Sestra</option>
                            </select>
                        </div>
                        <button id="save₋11" type="submit">Uložit</button>
                    </div>
                </form>
            </add_form>
            <?php
        }
        ?>
        <table>
            <tr>
                <th>email</th>
                <th>Příjmení</th>
                <th>Jméno</th>
                <th>Zařazení</th>
                <?php if($doc) echo "<th>Odstranit</th>"; ?>
            </tr>
            <?php
            $employees = get_employees();
            foreach ($employees as $row) {
                echo "<tr>";
                echo "<td>".$row["email"]."</td>";
                echo "<td>".$row["fname"]."</td>";
                echo "<td>".$row["surname"]."</td>";
                if($row["doc"] == 1 ) echo "<td>Doktor</td>";
                else echo "<td>Zdravotní sestra</td>";
                if($doc){
                    echo '<td>
                      <form action="../backend/save/remove_employee.php" method="post">
                        <input name="delete_id" type="hidden" value='.$row["email"].'>
                        <button onclick="return confirm(\'Opravdu chcete smazat záznam o zaměstnanci?\')">SMAZAT</button>
                      </form>
                      </td>
                    ';
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