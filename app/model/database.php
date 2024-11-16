<?php
    class Database {
        private $servername = "localhost";
        private $username = "root";
        private $password = "";
        private $dbname = "ngulongbakery";
        private $conn;

        function __construct() {
            try {
                $this->conn = new PDO("mysql:host={$this->servername};dbname={$this->dbname};charset=utf8", $this->username, $this->password);
                $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                // echo "Connected successfully";
            } catch(PDOException $e) {
                echo "Connection failed: " . $e->getMessage();
            }
        }

        function query($sql, $params = []) {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;
        }

        function getAll($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
            $statement = $this->query($sql, $params);
            return $statement->fetchAll($fetchMode);
        }

        function get($sql, $params = [], $fetchMode = PDO::FETCH_ASSOC) {
            $statement = $this->query($sql, $params);
            return $statement->fetch($fetchMode);
        }

        function execute($sql, $params = []) {
            return $this->query($sql, $params);
        }

        function lastInsertId() {
            return $this->conn->lastInsertId();
        }

        function __destruct() {
            unset($this->conn);
        }
    }
?>
