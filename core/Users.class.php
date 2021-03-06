<?php

class User {
    private $_db;

    public function __construct() {
        $this->_db = DB::getInstance();
    }

    /**
     * Validates, creates a new user (across 2 tables) and login in
     * @param $details
     * @param $login
     * @return string
     */
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

    /**
     * Validates and updates a user's personal data (and updates the session)
     * @param $user_id
     * @param $details
     * @param $login
     * @return string
     */
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
            "user_birthdate='{$birthdate}', user_about='{$details[6]['value']}' WHERE user_id={$user_id}");

        if (!$ret) {
            $login->fillSession($this->getUserById($user_id));
        }

        return $ret;
    }

    /**
     * Uploads a profile image for a user
     * @param $user_id
     * @param $photo
     * @param $login
     * @return mixed
     */
    public function uploadPhoto( $user_id, $photo, $login ) {
        return $this->uploadImage($user_id, $photo, $login, 'photos', 'user_profile_picture');
    }

    /**
     * Uploads a cover image for a user
     * @param $user_id
     * @param $photo
     * @param $login
     * @return mixed
     */
    public function uploadCover( $user_id, $photo, $login ) {
        return $this->uploadImage($user_id, $photo, $login, 'covers', 'user_secret_picture');
    }

    /**
     * Saves an uploaded image, updates the corresponding table field and updates the session
     * @param $user_id
     * @param $img
     * @param $login
     * @param $folder
     * @param $table_field
     * @return mixed
     */
    private function uploadImage($user_id, $img, $login, $folder, $table_field) {
        $info = new SplFileInfo($img['name']);
        $ext = $info->getExtension();
        $filename = $user_id . '.' . $ext;
        move_uploaded_file($img['tmp_name'], "../user_content/{$folder}/" . $filename);
        $this->_db->query( "UPDATE " . TBL_USERS_INFO . " SET {$table_field}='{$filename}' WHERE user_id={$user_id}");
        $login->fillSession($this->getUserById($user_id));
        return $img;
    }

    /**
     * Validates and changes password for a user
     * @param $user_id
     * @param $passwords
     * @return string
     */
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

    /**
     * Gets a user by id
     * Populates with custom data
     * @param $id
     * @return array|bool|mysqli_result
     */
    public function getUserById( $id ) {
        $user = $this->_db->query( "SELECT * FROM " . TBL_USERS . " INNER JOIN " . TBL_USERS_INFO . " ON " . TBL_USERS . ".user_id=". TBL_USERS_INFO . ".user_id WHERE " . TBL_USERS . ".user_id = $id" );
        $user = $user->fetch_assoc();
        $year_seconds = 31556926;
        $user['full_name'] = $user['user_firstname'] . ' ' . $user['user_lastname'];
        $user['user_birthdate_hebrew'] = date("d/m/Y", strtotime($user['user_birthdate']));
        $user['age'] = floor((time() - strtotime($user['user_birthdate'])) / $year_seconds);
        return $user;
    }

    /**
     * Deletes a user by id
     * @param $id
     * @return bool|mysqli_result
     */
    public function deleteUser( $id ) {
        return $this->_db->query( "DELETE FROM " . TBL_USERS . " WHERE user_id = $id" );
    }
}