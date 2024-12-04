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

        function register($fullname, $email, $password, $verificationCode) {
            $sql = "INSERT INTO users (`full_name`, `email`, `password`, `verification_code`) VALUES (?, ?, ?, ?)";
            return $this->db->execute($sql, [$fullname, $email, $password, $verificationCode]);
        }

        function verify($code) {
            $sql = "UPDATE users SET is_verified = 1 WHERE verification_code = ? AND is_verified = 0";
            return $this->db->execute($sql, [$code]);

        }
        
        function getUserByEmail($email) {
            $sql = "SELECT * FROM users WHERE email = ? AND status = 1 AND is_verified = 1";
            return $this->db->get($sql, [$email]);
        }        

        function saveResetCode($email, $resetCode) {
            $sql = "UPDATE users SET reset_code = ? WHERE email = ? AND is_verified = 1 AND status = 1";
            return $this->db->execute($sql, [$resetCode, $email]);
        }
        
        function resetPassword($resetCode, $newPassword) {
            $sql = "UPDATE users SET password = ?, reset_code = NULL WHERE reset_code = ? AND status = 1";
            return $this->db->execute($sql, [$newPassword, $resetCode]);
        }        

        function updateInformation($id, $fullname, $phone, $address, $avatar) {
            $sql = "UPDATE users SET `full_name` = ?, `phone` = ?, `address` = ?, `avatar` = ? WHERE `id` = ? AND status = 1";
            return $this->db->execute($sql, [$fullname, $phone, $address, $avatar, $id]);
        }

        function changePassword($id, $newPassword) {
            $sql = "UPDATE users SET `password` = ? WHERE `id` = ? AND status = 1";
            return $this->db->execute($sql, [$newPassword, $id]);
        }    
    }
?>