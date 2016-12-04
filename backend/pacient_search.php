<?php
require_once("../backend/database.php");
if($_GET['keyword'] && !empty($_GET['keyword']))
{
    $keyword = $_GET['keyword'];
    $req = '
            SELECT P.ID_RC AS  "id", P.JMENO AS  "fname", P.PRIJMENI AS "surname", P.MAIL AS "mail"
            FROM PACIENT P
            WHERE P.PRIJMENI LIKE ?
            ORDER BY P.PRIJMENI ASC;
        ';
    $vals = array("%".$keyword."%");

    $db = new Database();
    $q = $db->send_query($req, $vals);
    $pacients = $q->get_data();
    echo '<table>
                    <tr>
                        <th>Příjmení</th>
                        <th>Jméno</th>
                        <th>Rodné číslo</th>
                        <th>Kontakt</th>
                    </tr>';
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
    echo "</table>";
}
?>