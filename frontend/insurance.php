<?php
session_start();
$title = "Pojišťovny";
include "header.php";
require_once ("../backend/insurance.php");
?>
<div class="site">
    <div class="content">
        <h1>Pojišťovny</h1>
            <table border="1">
               <tr>
                    <th>Číslo</th>
                    <th>Název</th>
                    <th>Počet klientů</th>
                    <th>Odstranit</th>
                </tr>
                <?php
                $insurance_comps = get_insurance_comps();
                foreach ($insurance_comps as $row) {
                    echo "<tr>";
                    echo "<td>".$row["id"]."</td>";
                    echo "<td>".$row["name"]."</td>";
                    echo "<td>".$row["count"]."</td>";
                    if ($row["count"] == 0){
                        echo '<td>
                          <form action="../backend/remove_insur.php" method="post">
                            <input name="delete_id" type="hidden" value='.$row["id"].'>
                            <button>SMAZAT</button>
                          </form>
                          </td>
                     ';
                    } else {
                        echo "<td>------</td>";
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