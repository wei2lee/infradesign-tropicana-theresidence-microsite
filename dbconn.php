<?php
class Database
{
    protected static $_instance = null;

    protected $_conn = null;

    protected $_config = array(
        'username' => '',
        'password' => '',
        'hostname' => 'localhost',
        'database' => ''
    );

    protected function __construct() {
    }

    public static function getInstance()
    {
        if (null === self::$_instance) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }

    public function getConnection() {
        if (is_null($this->_conn)) {
            $db = $this->_config;
            $this->_conn = mysql_connect($db['hostname'], $db['username'], $db['password']);
            if(!$this->_conn) {
                die("Cannot connect to database server"); 
            }
            if(!mysql_select_db($db['database'])) {
                die("Cannot select database");
            }
        }
        return $this->_conn;
    }

    public function query($query) {
        $conn = $this->getConnection();
		mysql_query("/*!40101 SET NAMES 'UTF8' */", $conn);
		mysql_query("SET character_set_client=utf8", $conn);
		mysql_query("SET character_set_connection=utf8", $conn);

        return mysql_query($query, $conn);
    }
}
?>