<?php
include_once 'DbConfig.php';

class Crud extends DbConfig {
    public function __construct() {
        parent::__construct(); // calls the constructor of the parent class DbConfig using parent::__construct()
    }

    public function getData($query) {
        $result = $this->connection->query($query);

        if ($result == false) {
            return false;
        }

        $rows = array();

        while ($row = $result->fetch_assoc()) { // Added parentheses after fetch_assoc
            $rows[] = $row;
        }
        return $rows;
    }

    public function execute($query) {
        $result = $this->connection->query($query);

        if ($result == false) {
            echo "Error: cannot execute the command";
            return false;
        } else {
            return true;
        }
    }

    public function delete($id, $table) {
        $query = "DELETE FROM $table WHERE id = $id";
        $result = $this->connection->query($query);
        if ($result == false) {
            echo "Error: cannot delete id " . $id . " from table " . $table; // Corrected the error message syntax
            return false;
        } else {
            return true;
        }
    }

    public function escape_string($value)
	{
		return $this->connection->real_escape_string($value);
	}
}
?>
