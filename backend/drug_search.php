<?php
require_once("../backend/database.php");
if($_GET['keyword'] && !empty($_GET['keyword']))
{
    $keyword = $_GET['keyword'];
    $req = '
            SELECT L.NAZEV AS  name, L.DRUH AS  drug_type, L.POPIS AS description, L.ID_LEKU AS id_drug
            FROM LEK L
            WHERE L.NAZEV LIKE ?
            ORDER BY L.NAZEV ASC;
        ';
    $vals = array("%".$keyword."%");

    $db = new Database();
    $q = $db->send_query($req, $vals);
    $data = $q->get_data();
    if (sizeof($data) !== 0){
        foreach ($data as $row)
        {
            echo "<div class='searchitem'>".$row["name"]."</div>";
        }
    }
}
?>