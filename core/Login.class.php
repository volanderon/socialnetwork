<?php

class Login {

    private $_db;

    public function __construct(){
        $this->_db = DB::getInstance();
    }

    /**
     * Fill session with user data
     * @param $user
     */
    public function fillSession($user) {
        $_SESSION['auth'] = $user;
    }

    /**
     * Logs user in if email + password combo exists
     * @param $email
     * @param $password
     * @param $user
     * @return string
     */
    public function login($email, $password, $user) {
        $user_id = $this->checkIfValidUser($email, $password);
        if ($user_id) {
            $this->fillSession($user->getUserById($user_id['user_id']));
            return '';
        }
        return 'No such account';
    }

    /**
     * Logout and clear session
     */
    public function logout() {
        $_SESSION['auth'] = null;
    }

    /**
     * Check if a user is valid (by email and password)
     * @param $email
     * @param $password
     * @return array
     */
    private function checkIfValidUser($email, $password) {
        $query = "SELECT " . TBL_USERS . ".user_id FROM " . TBL_USERS . " INNER JOIN " . TBL_USERS_INFO . " ON " .
            TBL_USERS . ".user_id=". TBL_USERS_INFO . ".user_id WHERE user_email ='$email' AND user_password='" . md5($password) . "' ";
        $result = $this->_db->query($query);

        return $result->fetch_assoc();
    }
}
