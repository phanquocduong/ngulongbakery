<?php
    class LocationModel {
        private $db;

        public function __construct() {
            $this->db = new Database();
        }

        public function getProvinces() {
            $sql = "SELECT * FROM provinces ORDER BY name";
            return $this->db->getAll($sql); 
        }

        public function getDistricts($provinceId) {
            $sql = "SELECT * FROM districts WHERE province_id = ?";
            return $this->db->getAll($sql, [$provinceId]); 
        }

        public function getWards($districtId) {
            $sql = "SELECT * FROM wards  WHERE district_id  = ?";
            return $this->db->getAll($sql, [$districtId]); 
        }

        public function getWard($id) {
            $sql = "SELECT * FROM wards  WHERE id  = ?";
            return $this->db->get($sql, [$id]); 
        }

        public function getDistrict($id) {
            $sql = "SELECT * FROM districts WHERE id = ?";
            return $this->db->get($sql, [$id]); 
        }

        public function getProvince($id) {
            $sql = "SELECT * FROM provinces WHERE id = ?";
            return $this->db->get($sql, [$id]); 
        }
    }
?>