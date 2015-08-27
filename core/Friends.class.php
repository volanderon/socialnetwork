<?php

class Friends {

    private $_db;

    /**
     *  __construct
     *
     * This function get single connection to a database and put it in $this->_db
     *
     * @no param needed
     * @no return
     */

    public function __construct () {
        $this->_db = DB::getInstance();
    }


    /**
     *  getAllFriends
     *
     * This function returns an array of all friends ID for the user.
     *
     * @param (int) ( $id ) The ID of the user asks his friend list
     * @param int $limit
     * @return array ( $friends ) num array with friends ID
     */

    public function getAllFriends( $id, $limit = 99999 ){

        $query = "SELECT SQL_CALC_FOUND_ROWS * FROM ((SELECT " . TBL_USERS_INFO . ".* FROM friends INNER JOIN " . TBL_USERS_INFO . " ON friends.user_friend_id=" . TBL_USERS_INFO . ".user_id WHERE friends.user_id = $id)
				UNION (SELECT " . TBL_USERS_INFO . ".* FROM friends INNER JOIN " . TBL_USERS_INFO . " ON friends.user_id=" . TBL_USERS_INFO . ".user_id WHERE friends.user_friend_id = $id)) AS tmp LIMIT $limit";

        $results = $this->_db->query($query);
        $count = $this->_db->query('SELECT FOUND_ROWS() AS count');
        $friends = array();

        while ( $row = $results->fetch_assoc() ){
            $friends[] = $row;
        }

        return ['count' => $count->fetch_assoc()['count'], 'friends' => $friends];
    }

};