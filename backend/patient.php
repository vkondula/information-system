<?php
session_start();
require_once("database.php");
function get_patient_info($code){
    $db = new Database();
    $req = '
    SELECT P.ID_RC AS  "rc", P.JMENO AS  "name", P.PRIJMENI AS  "surname",
    P.ULICE AS  "street", P.CISLO_POPISNE AS  "str_number", P.MESTO AS  "city",
    P.PSC AS  "postal_code", P.DATUM_NAROZENI AS  "birthdate", P.EVIDOVAN_OD AS  "evidence",
    P.ID_POJISTOVNA AS  "insurance"   
    FROM PACIENT P
    WHERE P.ID_RC = '.$code.';
    ';
    $q = $db->send_query($req, array());
    return $q->get_data();
}
