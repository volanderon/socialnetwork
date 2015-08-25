<?php
require_once dirname( __FILE__ ) . '/../lib/DB.class.php';

class User {
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function createNewUser( $details ) {
        $success = $this->_db->query( "INSERT INTO " . TBL_USERS . " (user_email, user_password) VALUES ('".$details['email']."', '".md5( $details['password'] )."')");

        return $success;
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