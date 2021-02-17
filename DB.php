<?php
class DB
{
    private $con;
    private $table;


    public function __construct($table_name)
    {
        $this->table = $table_name;
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "tictactoe";

        $this->con = new mysqli($servername, $username, $password, $dbname);
        if ($this->con->connect_error) {
            die("Connection failed: " . $this->con->connect_error);
        }
    }

    public function __destruct()
    {
        $this->con->close();
    }


    public function set($entries)
    {
        $columns = '';
        $values = '';
        $i = 0;
        foreach ($entries as $key => $value) {
            $columns .= "`$key`";
            $values .= "'$value'";
            $i++;
            if (count($entries) > $i) {
                $columns .= ", ";
                $values .= ", ";
            }
        }

        $sql = "INSERT INTO `$this->table` ($columns) VALUES ($values);";
        $result = $this->con->query($sql);
        if ($result === true) {
            return $this->con->insert_id;
        } else {
            echo $this->con->error;
        }
    }
}
