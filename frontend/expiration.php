<?php
session_start();
$title = "Expirace";
require_once("../backend/examination.php");
include "header.php";
?>
    <div class="site">
        <div class="content">
            <h1>Expirace výkonů nejbližších 30 dnů</h1>
            <table>
                <tr>
                    <th>Příjmení</th>
                    <th>Jméno</th>
                    <th>Výkon</th>
                    <th>Datum expirace</th>
                    <th>Zaslat pozvánku</th>
                </tr>
                <?php
                $pacients = get_examination_expirations();
                foreach ($pacients as $row) {
                    $d = new DateTime($row["date"]);
                    $d = date('Y-m-d', strtotime($Date. ' + '.$row["exp"].' days'));
                    $d = new DateTime($d);
                    $diff=date_diff(new DateTime(), $d);
                    $expiration = $diff->format("%R%a");
                    if ($expiration > 0 && $expiration <= 30)
                    {
                        $add = $row["email"];
                        $ex = $row["exam"];
                        $exp_str = date_format($d, 'Y-m-d');
                        echo "<tr class=\"patient_row\" onclick=\"window.document.location='pacient.php?id=".$row["id"]."';\">";
                        echo "<td>".$row["surname"]."</td>";
                        echo "<td>".$row["name"]."</td>";
                        echo "<td>".$row["exam"]."</td>";
                        echo "<td>".$exp_str."</td>";
                        echo "<td>
                             <form action=\"mailto.php\" method=\"post\">
                                    <input type=\"hidden\" name=\"address\" value=\"$add\">
                                    <input type=\"hidden\" name=\"exam\" value=\"$ex\">
                                    <button type=\"submit\">Poslat mail</button>
                              </form>
                          </td>";
                        echo "</tr>";
                    }
                }
                ?>
            </table>
        </div>
    </div>
<?php
include "footer.php";
?>