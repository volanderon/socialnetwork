<?php
require_once dirname( __FILE__ ) . '/../lib/DB.class.php';

class User {
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function createNewUser( $details ) {
        $ret = '';

        if (!preg_match("/^[a-zA-Z]+$/", $details[0]['value'])) {
            $ret = 'Bad first name format';
            return $ret;
        }
        if (!preg_match("/^[a-zA-Z]+$/", $details[1]['value'])) {
            $ret = 'Bad last name format';
            return $ret;
        }
        if (!filter_var($details[2]['value'], FILTER_VALIDATE_EMAIL)) {
            $ret = 'Bad email format';
            return $ret;
        }
        if ($details[3]['value'] !== $details[4]['value']) {
            $ret = 'Passwords do not match';
            return $ret;
        }

        $this->_db->query( "INSERT INTO " . TBL_USERS . " (user_email, user_password) VALUES ('".$details[2]['value']."', '".md5( $details[3]['value'] )."')");
        $user_id = mysqli_insert_id($this->_db);
        $this->_db->query( "INSERT INTO " . TBL_USERS_INFO . " (user_id, user_firstname, user_lastname, user_created)" .
            " VALUES (" . $user_id . ", '".$details[0]['value']."', '". $details[1]['value'] ."', '" . date('Y-m-d H:i:s') . "')");

        if (mysqli_errno($this->_db) === 1062) {
            $ret = 'This email is already taken';
        }

        return $ret;
    }

    public function getAllUsers() {
        $users = $this->_db->query( "SELECT * FROM " . TBL_USERS );

        $users = array();

        while ( $row = $users->fetch_assoc() )
            $users[] = $row;

        return $users;
    }

    public function getUserById( $id ) {
        $users = $this->_db->query( "SELECT * FROM " . TBL_USERS . " WHERE user_id = $id" );
        return $users->fetch_assoc();
    }

    public function deleteUser( $id ) {
        return $this->_db->query( "DELETE FROM " . TBL_USERS . " WHERE user_id = $id" );
    }
}