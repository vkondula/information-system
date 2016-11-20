<?php
session_start();
require_once("database.php");

function get_mtgs($date){
    $req = 'SELECT T.DATUM_CAS AS m_date, P.ID_RC AS id_pat,
        P.JMENO AS fname, P.PRIJMENI AS surname, T.ID_TERMINU AS id_v
        FROM TERMIN T INNER JOIN PACIENT P ON P.ID_RC = T.ID_PACIENT
        WHERE DATE_FORMAT(T.DATUM_CAS, "%Y-%m-%d") = ?
        ORDER BY T.DATUM_CAS ASC; 
     ';
    $db = new Database();
    $q = $db->send_query($req, array($date));
    return $q->get_data();
}