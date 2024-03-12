<?php

class DbConfig{
    private $_host =   'localhost';
    private $_username = 'root';
	private $_password = '';
	private $_database = 'project1_db';

      // Protected property to store database connection object
    protected $connection;
// Constructor method to establish database connection
    public function __construct()
    {
         // Check if connection property is not set
        if(!isset($this->connection)){
            $this->connection = new mysqli($this->_host, $this->_username, $this->_password, $this->_database );

            if (!$this->connection) {
				echo 'Cannot connect to database server';
				exit;
			}

        }

        return $this->connection;
    }
}

?>