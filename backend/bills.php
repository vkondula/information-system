<?php
session_start();
require_once("database.php");

function get_bills($date){
    $req = 'SELECT F.DATUM AS b_date, F.CENA AS price, F.DOPLATEK AS extra,
        P.ID_RC AS id_pat, P.ID_POJISTOVNA AS id_ins
        FROM FAKTURA F
        INNER JOIN TERMIN T ON T.ID_TERMINU = F.ID_TERMINU
        INNER JOIN PACIENT P ON P.ID_RC = T.ID_PACIENT
        WHERE DATE_FORMAT(F.DATUM, "%Y-%m") = ?
        ORDER BY F.DATUM DESC; 
     ';
    $db = new Database();
    $q = $db->send_query($req, array($date));
    return $q->get_data();
}