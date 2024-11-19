<?php
class CategoryModel
{
    private $db;
    function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    function getCate()
    {
        $sql = "SELECT * FROM categories";
        return $this->db->getAll($sql);
    }
    public function getIdPro($id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ? LIMIT 1";
        return $this->db->getOne($sql, [$id]);
    }
    public function getIdCate($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function countProductsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) as count FROM products WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row['count'];
    }
    public function getProductsByCategoryId($categoryId)
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        return $this->db->getAll($sql, [$categoryId]);
    }
    public function insertCate($data)
    {
        $sql = "INSERT INTO categories (name, image, description, type, status) VALUES (?,?,?,?,?)";
        $param = [$data['name'], $data['image'], $data['description'], $data['type'], $data['status']];
        return $this->db->insert($sql, $param);
    }
    function deleteCate($id)
    {
        $sql = "DELETE FROM categories WHERE id = ?";
        $param = [$id];
        return $this->db->delete($sql, $param);
    }
    function updateCate($data) {
        $sql = "UPDATE categories SET name = ?, image = ?, description = ?, type = ?, status = ? WHERE id = ?";
        $params = [$data['name'], $data['image'], $data['description'], $data['type'], $data['status'], $data['id']
        ];
        return $this->db->update($sql, $params);
    }
    public function isForeignKey($id) {
        $query = "SELECT COUNT(*) as count FROM products WHERE category_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    
    
}
