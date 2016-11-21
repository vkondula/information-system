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
    WHERE P.ID_RC = ?;
    ';
    $q = $db->send_query($req, array($code));
    return $q->get_data();
}


function get_patients($name=null){
    if (!empty($name)){
        $req = '
            SELECT P.ID_RC AS  "id", P.JMENO AS  "fname", P.PRIJMENI AS "surname"
            FROM PACIENT P
            WHERE P.PRIJMENI LIKE ?
            ORDER BY P.PRIJMENI ASC;
        ';
        $vals = array("%".$name."%");
    } else {
        $req = '
            SELECT P.ID_RC AS  "id", P.JMENO AS  "fname", P.PRIJMENI AS "surname"
            FROM PACIENT P ORDER BY P.PRIJMENI ASC, P.JMENO ASC;
         ';
        $vals = array();
    }
    $db = new Database();
    $q = $db->send_query($req, $vals);
    return $q->get_data();
}


function get_last_visit($id){
    $req = 'SELECT ID_TERMINU AS id
        FROM TERMIN T INNER JOIN PACIENT P ON T.ID_PACIENT = P.ID_RC
        WHERE P.ID_RC = ?
        ORDER BY T.DATUM_CAS DESC
        LIMIT 1;
     ';
    $db = new Database();
    $q = $db->send_query($req, array($id));
    $visits = $q->get_data();
    if(empty($visits)) return null;
    return $visits[0]["id"];
}

function get_all_visits($id){
    $req = 'SELECT ID_TERMINU AS id, DATUM_CAS AS datetime
        FROM TERMIN T INNER JOIN PACIENT P ON T.ID_PACIENT = P.ID_RC
        WHERE P.ID_RC = ?
        ORDER BY T.DATUM_CAS DESC;
     ';
    $db = new Database();
    $q = $db->send_query($req, array($id));
    return $q->get_data();
}

function get_visit_info($v){
    $req = 'SELECT DATUM_CAS AS datetime, ZPRAVA AS report
        FROM TERMIN
        WHERE ID_TERMINU = ?
     ';
    $db = new Database();
    $q = $db->send_query($req, array($v));
    return $q->get_data();
}

function prescribed_drugs($v){
    $req = 'SELECT L.NAZEV AS name, L.DRUH AS drug_type, T.ID_TERMINU AS id_term,
        T.ID_LEKU AS id_drug, T.POCET_BALENI AS drug_count
        FROM TERMIN_LEK T INNER JOIN LEK L ON T.ID_LEKU = L.ID_LEKU
        WHERE T.ID_TERMINU = ?;
     ';
    $db = new Database();
    $q = $db->send_query($req, array($v));
    return $q->get_data();
}

function get_bill($v){
    $req = 'SELECT DATUM AS b_date, CENA AS price, DOPLATEK AS extra,
        ID_FAKTURY AS id_bill
        FROM FAKTURA
        WHERE ID_TERMINU = ?;
     ';
    $db = new Database();
    $q = $db->send_query($req, array($v));
    return $q->get_data();
}

function is_insurance_in_db($ins){
    $req = 'SELECT ID_CP FROM POJISTOVNA WHERE ID_CP = ?';
    $db = new Database();
    $q = $db->send_query($req, array($ins));
    return $q->get_count() == 1;
}

function is_rc_valid($rc){
    if(filter_var((string)$rc, FILTER_VALIDATE_INT) === false) return false;
    if($rc % 11 != 0) return false;
    if(strlen((string)$rc) != 10) return false;
    return true;
}

function is_rc_uniq($rc){
    $req = 'SELECT ID_RC FROM PACIENT WHERE ID_RC = ?;';
    $db = new Database();
    $q = $db->send_query($req, array($rc));
    return $q->get_count() == 0;
}

function is_all_set($post, $required){
    foreach($required as $r){
        if ($post[$r] == null) return false;
    }
    return true;
}