<?php
// Tương tác với bảng taikhoan
    class UserModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        function checkMail($email) {
            $sql = "SELECT * FROM users WHERE email = ?";
            return $this->db->get($sql, [$email]);
        }

        function register($fullname, $email, $password) {
            $sql = "INSERT INTO users (`full_name`, `email`, `password`) VALUES (?, ?, ?)";
            return $this->db->execute($sql, [$fullname, $email, $password]);
        }
    }
?>