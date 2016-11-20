<?php
session_start();
require_once("database.php");

function get_drugs($name=null){
    if (!empty($name)){
        $req = '
            SELECT L.NAZEV AS  name, L.DRUH AS  drug_type, L.POPIS AS description, L.ID_LEKU AS id_drug
            FROM LEK L
            WHERE L.NAZEV LIKE ?
            ORDER BY L.NAZEV ASC;
        ';
        $vals = array("%".$name."%");
    } else {
        $req = '
            SELECT L.NAZEV AS  name, L.DRUH AS  drug_type, L.POPIS AS description, L.ID_LEKU AS id_drug
            FROM LEK L
            ORDER BY L.NAZEV ASC;
         ';
        $vals = array();
    }
    $db = new Database();
    $q = $db->send_query($req, $vals);
    return $q->get_data();
}