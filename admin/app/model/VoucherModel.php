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
}