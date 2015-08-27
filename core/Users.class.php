<?php
require_once dirname( __FILE__ ) . '/../lib/DB.class.php';

class User {
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    public function createNewUser( $details, $login ) {
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

        if (!$ret) {
            $login->fillSession($this->getUserById($user_id));
        }

        return $ret;
    }

    public function updateUserGeneral( $user_id, $details, $login ) {
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

        $this->_db->query( "UPDATE " . TBL_USERS . " SET user_email='".$details[2]['value']."' WHERE user_id={$user_id}");
        if (mysqli_errno($this->_db) === 1062) {
            $ret = 'This email is already taken';
        }

        $birthdate = "{$details[5]['value']}-{$details[4]['value']}-{$details[3]['value']}";
        $this->_db->query( "UPDATE " . TBL_USERS_INFO . " SET user_firstname='{$details[0]['value']}', user_lastname='{$details[1]['value']}', " .
            "user_birthdate='{$birthdate}', user_about='{$details[9]['value']}' WHERE user_id={$user_id}");

        if (!$ret) {
            $login->fillSession($this->getUserById($user_id));
        }

        return $ret;
    }

    public function uploadPhoto( $user_id, $photo, $login ) {
        return $this->uploadImage($user_id, $photo, $login, 'photos', 'user_profile_picture');
    }

    public function uploadCover( $user_id, $photo, $login ) {
        return $this->uploadImage($user_id, $photo, $login, 'covers', 'user_secret_picture');
    }

    private function uploadImage($user_id, $img, $login, $folder, $table_field) {
        $info = new SplFileInfo($img['name']);
        $ext = $info->getExtension();
        $filename = $user_id . '.' . $ext;
        move_uploaded_file($img['tmp_name'], "../user_content/{$folder}/" . $filename);
        $this->_db->query( "UPDATE " . TBL_USERS_INFO . " SET {$table_field}='{$filename}' WHERE user_id={$user_id}");
        $login->fillSession($this->getUserById($user_id));
        return $img;
    }

    public function changePassword($user_id, $passwords) {
        $ret = '';
        $user = $this->getUserById($user_id);

        if ($user['user_password'] !== md5($passwords[0]['value'])) {
            $ret = 'Old Password is incorrect';
        } else if (!$passwords[1]['value'] || $passwords[1]['value'] !== $passwords[2]['value']) {
            $ret = 'New Passwords do not match';
        } else {
            $this->_db->query( "UPDATE " . TBL_USERS . " SET user_password='".md5($passwords[1]['value'])."' WHERE user_id={$user_id}");
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
        $users = $this->_db->query( "SELECT * FROM " . TBL_USERS . " INNER JOIN " . TBL_USERS_INFO . " ON " . TBL_USERS . ".user_id=". TBL_USERS_INFO . ".user_id WHERE " . TBL_USERS . ".user_id = $id" );
        return $users->fetch_assoc();
    }

    public function deleteUser( $id ) {
        return $this->_db->query( "DELETE FROM " . TBL_USERS . " WHERE user_id = $id" );
    }
}