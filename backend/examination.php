<?php
session_start();
require_once("database.php");

function get_examinations($name=null){
    if (!empty($name)){
        $req = '
            SELECT V.NAZEV_VYKONU AS name, V.EXPIRACE AS expiration, V.ID_VYKONU AS id
            FROM VYKON V
            WHERE V.NAZEV_VYKONU LIKE ?
            ORDER BY V.NAZEV_VYKONU ASC;
        ';
        $vals = array("%".$name."%");
    } else {
        $req = '
            SELECT V.NAZEV_VYKONU AS name, V.EXPIRACE AS expiration, V.ID_VYKONU AS id
            FROM VYKON V
            ORDER BY V.NAZEV_VYKONU ASC;
         ';
        $vals = array();
    }
    $db = new Database();
    $q = $db->send_query($req, $vals);
    return $q->get_data();
}


function find_examination($name){
    $req = 'SELECT ID_VYKONU AS id_exam FROM VYKON WHERE NAZEV_VYKONU = ?';
    $vals = array($name);
    $db = new Database();
    $q = $db->send_query($req, $vals);
    $ret = $q->get_data();
    if(empty($ret)) return null;
    return $ret[0]["id_exam"];
}