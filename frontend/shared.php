<?php
class Site{
    public $title = "Informační systém";

    public function set_title($title){
        $this->title = $title;
    }

    public function print_header(){
        $title = $this->title;
        include "header.php";
    }

    public function print_footer(){
        echo "</body></html>";
    }

    public function print_login_form(){
        include "log_form.php";
    }

    public function print_password_form(){
        include "pass_form.php";
    }

    public function print_logout(){
        echo "<a href='../backend/log_out.php'>log out</a>";
    }

    public function print_error(){
        if (!empty($_SESSION["error"])){
            # todo: format me
            echo $_SESSION["error"];
            unset($_SESSION["error"]);
        }
    }
}