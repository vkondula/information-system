<?php

class Database extends DbConnection{

    public function log_in($email, $pass){
        if(!empty($pass)){
            $q = "SELECT * from ZAMESTNANEC WHERE email = ? and password = ?;";
            $args = array($email, hash("sha256", $pass));
        } else {
            $q = "SELECT * from ZAMESTNANEC WHERE email = ? and password is null;";
            $args = array($email);
        }
        $ans = $this->send_query($q, $args);
        if (count($ans) == 1){
            return $ans[0];
        }
        return null;
    }

}


class DbConnection{
    private static $conn = null;
    private static $user = "w85788_demo";
    private static $passwd = "Kfp92csg";
    private static $host = "wm76.wedos.net";
    private static $dbname = "d85788_demo";
    private static $engine = "mysql";


    public function __construct(){
        if (!self::$conn)
            self::create_connection();
    }

    public function reload_connection(){
        self::create_connection();
    }

    private function create_connection(){
        $cmd = self::$engine.':dbname='.self::$dbname.";host=".self::$host.";charset=gbk";
        self::$conn = new PDO($cmd, self::$user, self::$passwd);
    }

    public function disconnect(){
        self::$conn = null;
    }

    protected function send_query($query, $values){
        $stmt = self::$conn->prepare($query);
        if ($stmt->execute($values)) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
        return array();
    }

}