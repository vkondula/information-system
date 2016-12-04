<?php
require_once("../backend/database.php");
if($_GET['keyword'] && !empty($_GET['keyword']))
{
    $keyword = $_GET['keyword'];
    $req = '
            SELECT V.NAZEV_VYKONU AS name, V.EXPIRACE AS expiration, V.ID_VYKONU AS id
            FROM VYKON V
            WHERE V.NAZEV_VYKONU LIKE ?
            ORDER BY V.NAZEV_VYKONU ASC;
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