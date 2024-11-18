<?php
class VoucherModel{
    private $db;
    function __construct(){
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getVoucher(){
        $sql = "SELECT * FROM discounts";
        return $this->db->getAll($sql);
    }
    public function getIdVocher($idvoucher)
    {
        if ($idvoucher > 0) {
            // Sử dụng prepared statements để tránh SQL injection
            $sql ="SELECT * FROM discounts WHERE id = :idvoucher";
            $params = [':idvoucher' => $idvoucher];
            return $this->db->get($sql, $params);
        } else {
            return null;
        }
    }
}