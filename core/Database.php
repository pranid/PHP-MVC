<?php

/**
 * Created by PhpStorm.
 * User: Praneeth Nidarshan
 * Date: 10/19/2016
 * Time: 6:59 PM
 */
class Database
{
    private $connection;
    private $select_data;
    private $insert_data;
    private $table;
    private $condition;
    private $order;
    private $limit;

    public function __construct()
    {
        global $_config;
        $host = $_config['db']['server'];
        $port = $_config['db']['port'];
        $database = $_config['db']['database'];
        $username = $_config['db']['username'];
        $password = $_config['db']['password'];
        $db_drive = $_config['db']['driver'];

        try {
            if ($db_drive == 'postgres') {
                $port = (isset($port) ? $port : 5432);
                $this->connection = new PDO("pgsql:host=$host;port:$port;dbname=$database", $username, $password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } else if ($db_drive == 'mysqli') {
                $port = (isset($port) ? $port : 3306);
                $this->connection = new PDO("mysql:host=$host;port:$port;dbname=$database", $username, $password,
                    array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
            } else {
                die("Sorry, Database Driver $db_drive Not Supported.");
            }
        } catch (PDOException $e) {
            die($e->getMessage());
        }

    }


    /**
     * Set select data
     */
    public function select($select_data)
    {
        $this->select_data = $select_data;
    }

    /**
     * Set table
     */
    public function from($table)
    {
        $this->table = $table;
    }

    /**
     * Set where
     */
    public function where($condition)
    {
        $this->condition = $condition;
    }

    /**
     * Set order
     */
    public function order($order)
    {
        $this->order = $order;
    }

    /** Insert Query Builder */
    public function insert($table_name, $data)
    {
        // Creates Columns part of insert query
        $columns = implode(", ", array_keys($data));

        $values = "";

        // Creates Values part of insert query
        foreach (array_values($data) as $key => $value) {
            $values .= "'" . $value . "',";
        }

        $values = rtrim($values, ",");
        $sql = "INSERT INTO " . $table_name . " (" . $columns . ") VALUES (" . $values . ")";

        // return pg_affected_rows($this->executeQuery($sql));
        return $this->executeQuery($sql)->rowCount();
    }

    /** Select Query Builder */
    public function get($table_name = "")
    {
        $sql;
        // If table name set get all records
        if (isset($table_name)) {
            $sql = "SELECT * FROM $table_name";
        } else {
            $sql = "SELECT $this->select_data FROM $this->table ";

            // Check for the condition
            if ($this->condition) {
                $sql .= "WHERE $this->condition";
            }

            if ($this->order) {
                $sql .= "ORDER BY $this->order";
            }
        }

        return $this->executeQuery($sql)->fetchAll();
    }

    /** Update Query Builder */
    public function update($table_name, $data)
    {
        $column = array_keys($data);
        $value = array_values($data);

        $sql = "";
        $set = "";

        // Creats update part
        for ($i = 0; $i < sizeof($data); $i++) {
            $set .= $column[$i] . " = '" . $value[$i] . "', ";
        }

        $set = rtrim($set, " ,");

        $sql = "UPDATE " . $table_name . " SET " . $set;

        if ($this->condition) {
            $sql .= " WHERE $this->condition";
        }

        return $this->executeQuery($sql)->rowCount();
    }

    /** Delete Query Builder */
    public function delete($table_name)
    {
        $sql = "DELETE FROM " . $table_name;

        if ($this->condition) {
            $sql .= " WHERE $this->condition";
        }

        return $this->executeQuery($sql)->rowCount();
    }

    private function executeQuery($sql)
    {
        try {
            // return pg_fetch_assoc(pg_query($this->connection,$sql));
            return $this->connection->query($sql);
        } catch (Exception $e) {
            exit($e->getMessage());
        }
    }

}

?>