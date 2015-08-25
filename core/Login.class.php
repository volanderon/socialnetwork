<?php

class Login {

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function fillSession($user) {
        $_SESSION['auth'] = $user;
    }

    public function checkEmailAvailable($email){
        $query = "SELECT * FROM users WHERE user_email ='$email'; ";

        $result = $this->_db->query($query);

        return  $result->num_rows;
    }


}
