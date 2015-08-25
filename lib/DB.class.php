<?php
require_once dirname( __FILE__ ) . '/../config/config.php';

class DB {
	private static $instance = NULL;

    public static function getInstance() {
		if ( !self::$instance )
			self::$instance = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_DATABASE_NAME);

		return self::$instance;
    }

    private function __construct(){}
    private function __clone(){}
}