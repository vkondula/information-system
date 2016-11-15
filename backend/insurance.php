<?php
session_start();
require_once("database.php");
function get_insurance_comps(){
    $db = new Database();
    $req = '
    SELECT PO.ID_CP AS  "id", PO.JMENO AS  "name", COUNT( PA.ID_RC ) AS  "count"
    FROM POJISTOVNA PO
    LEFT JOIN PACIENT PA ON PO.ID_CP = PA.ID_POJISTOVNA
    GROUP BY PO.ID_CP;
    ';
    $q = $db->send_query($req, array());
    return $q->get_data();
}

function remove_insurance_comps($id){
    $db = new Database();
    $req = 'DELETE FROM POJISTOVNA WHERE ID_CP = ? ;';
    $q = $db->send_query($req, array($id));
    return $q->get_count();
}