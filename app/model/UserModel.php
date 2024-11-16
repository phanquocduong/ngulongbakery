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
            $sql = "SELECT id, is_verified FROM users WHERE verification_code = ?";
            $result = $this->db->get($sql, [$code]);
            
            if ($result) {
                if ($result['is_verified'] == 0) {
                    $sql = "UPDATE users SET is_verified = 1 WHERE verification_code = ?";
                    return $this->db->execute($sql, [$code]);
                } else {
                    return false; // Đã được xác minh trước đó
                }
            }
            return false; // Không tìm thấy mã
        }
        
        function getUserByEmail($email) {
            $sql = "SELECT * FROM users WHERE email = ?";
            return $this->db->get($sql, [$email]);
        }        

        function saveResetCode($email, $resetCode) {
            $sql = "UPDATE users SET reset_code = ? WHERE email = ?";
            return $this->db->execute($sql, [$resetCode, $email]);
        }
        
        function updatePassword($resetCode, $newPassword) {
            $sql = "SELECT id FROM users WHERE reset_code = ?";
            $user = $this->db->get($sql, [$resetCode]);
            if ($user) {
                $sql = "UPDATE users SET password = ?, reset_code = NULL WHERE reset_code = ?";
                return $this->db->execute($sql, [$newPassword, $resetCode]);
            }
            return false;
        }        
    }
?>