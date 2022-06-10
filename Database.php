<?php

class Database {
    private $configs;
    private $dbHost, $dbName, $dbUsername, $dbPassword, $dbPort;
    protected $conn;

    public function __construct() {
        $this->configs = include(ROOT . '/config.php');
        $this->dbHost = $this->configs['dbHost'];
        $this->dbName = $this->configs['dbName'];
        $this->dbUsername = $this->configs['dbUsername'];
        $this->dbPassword = $this->configs['dbPassword'];
        $this->dbPort = $this->configs['dbPort'];
    }

    public function connect() {
        if(!(isset($this->conn))) {
            try {
                $dsn = "mysql:host=$this->dbHost;dbname=$this->dbName;port=$this->dbPort";
                $this->conn = new PDO($dsn, $this->dbUsername, $this->dbPassword);
            } catch (connException $e) {
                echo "Error: " . $e->getMessage();
                exit();
            }
        }
        
        return $this->conn;
    }

    public function execute(string $sql, array $params = []) {
        $result = $this->conn->prepare($sql);
        if (!$result) {
            throw new Exception("query prepare error");
        }

        $result = $result->execute($params);

        if (!$result) {
            throw new Exception("query execute error");
        }

        return true;
    }

    public function getData(string $sql) {
        $result = $this->conn->query($sql);

        if (!$result) {
            throw new Exception("query error");
        }

        $rows = array();

        while ($row = $result->fetch()) {
            $rows[] = $row;
        }

        return $rows;
    }
}