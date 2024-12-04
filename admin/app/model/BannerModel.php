<?php
class BannerModel{
        private $db;
        function __construct()
        {
            require_once '../app/model/database.php';
            $this->db = new Database();
        }
    
        public function get_banner()
        {
            $sql = "SELECT * FROM banners ORDER BY id DESC";
            return $this->db->getAll($sql);
        }
    
        public function insertBanner($data)
        {
            $sql = "INSERT INTO banners (tag, image, status) VALUES (?, ?, ?)";
            $params = [$data['tag'], $data['image'], $data['status']];
            return $this->db->insert($sql, $params);
        }
        public function updateBanner($data) {
            $sql = "UPDATE banners SET tag = ?, status = ?, image = ?  WHERE id = ?";
            $params = [$data['tag'], $data['status'], $data['image'], $data['id']];
            return $this->db->update($sql, $params);
        }
        public function deleteBanner($idbanner){
            $sql = "DELETE FROM banners WHERE id = ?";
            return $this->db->delete($sql, [$idbanner]);
        }
        public function getIdBanner($idbanner)
        {
            if ($idbanner > 0) {
                // Sử dụng prepared statements để tránh SQL injection
                $sql ="SELECT * FROM banners WHERE id = :bannerid";
                $params = [':bannerid' => $idbanner];
                return $this->db->get($sql, $params);
            } else {
                return null;
            }
            
        }
    }
?>