<?php

class Login {

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    public function fillSession($user) {
        $year_seconds = 31556926;
        $user['full_name'] = $user['user_firstname'] . ' ' . $user['user_lastname'];
        $user['user_birthdate_hebrew'] = date("d/m/Y", strtotime($user['user_birthdate']));
        $user['age'] = floor((time() - strtotime($user['user_birthdate'])) / $year_seconds);
        $_SESSION['auth'] = $user;
    }

    public function login($email, $password) {
        $user = $this->checkIfValidUser($email, $password);
        if ($user) {
            $this->fillSession($user);
            return '';
        }
        return 'No such account';
    }

    public function logout() {
        $_SESSION['auth'] = null;
    }

    private function checkIfValidUser($email, $password) {
        $query = "SELECT * FROM " . TBL_USERS . " INNER JOIN " . TBL_USERS_INFO . " ON " . TBL_USERS . ".user_id=". TBL_USERS_INFO . ".user_id WHERE user_email ='$email' AND user_password='" . md5($password) . "' ";
        $result = $this->_db->query($query);

        return $result->fetch_assoc();
    }
}
