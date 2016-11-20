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
        <?php
            if($doc){
                ?>
                <div>
                    <h4>Nový zaměstnanec</h4>
                    <form action="../backend/save/emloyee_add.php" method="post">
                        <div>
                            <label><b>Jméno:</b></label>
                            <input class="left_input" type="text" name="fname" required>
                        </div>
                        <div>
                            <label><b>Příjmení:</b></label>
                            <input class="left_input" type="text" name="surname" required>
                        </div>
                        <div>
                            <label><b>Email:</b></label>
                            <input class="left_input" type="text" name="email" required>
                        </div>
                        <div>
                            <label><b>Zařazení:</b></label>
                            <select name="doctor">
                                <option value="1">Doktor</option>
                                <option value="0">Sestra</option>
                            </select>
                        </div>
                        <div>
                            <button id="save₋11" type="submit">Uložit</button>
                        </div>
                    </form>
                </div>
                <?php
            }
        ?>
    </div>
</div>
<?php
include "footer.php";
?>