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
    public function deleteVoucher($idvoucher){
        $sql = "DELETE FROM discounts WHERE id = ?";
        $param = [$idvoucher];
        return $this->db->delete($sql, $param);
    }
    public function insertVoucher($data)
    {
        $sql = "INSERT INTO discounts (code, discount_value, start_date, end_date, usage_limit, min_order_value, active) VALUES (?,?,?,?,?,?,?)";
        $param = [$data['code'], $data['discount_value'], $data['start_date'], $data['end_date'], $data['usage_limit'], $data['min_order_value'], $data['active']];
        return $this->db->insert($sql, $param);
    }
    function updateVoucher($data) {
        $sql = "UPDATE discounts SET code = ?, discount_value = ?, start_date = ?, end_date = ?, usage_limit = ?, min_order_value = ?, active = ? WHERE id = ?";
        $params = [$data['code'], $data['discount_value'], $data['start_date'], $data['end_date'], $data['usage_limit'], $data['min_order_value'], $data['active'], $data['id']];
        return $this->db->update($sql, $params);
        if (!$params) {
            echo "Cập nhật thất bại!";
            print_r($this->db->errorInfo()); // In lỗi nếu có
        }
    }
}