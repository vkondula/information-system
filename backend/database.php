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
        if ($ans->get_count() == 1){
            return $ans->get_data()[0];
        }
        return null;
    }

    public function set_password($email, $pass){
        $q = "UPDATE ZAMESTNANEC SET password = ? WHERE email = ?;";
        $args = array(hash("sha256", $pass), $email);
        return $this->send_query($q, $args)->get_count() == 1;
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

    public function send_query($query, $values){
        return new Query($query, $values, self::$conn);
    }

}

class Query{
    private $stmt;
    private $fetched;
    private $conn;

    public function __construct($query, $values, $conn){
        $this->conn = $conn;
        $this->stmt = $this->conn->prepare($query);
        $this->stmt->execute($values);
        $this->fetched = $this->stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function get_data(){
        return $this->fetched;
    }

    public function get_count(){
        return $this->stmt->rowCount();
    }
}
