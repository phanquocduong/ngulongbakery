<?php
class CategoryModel
{
    private $db;
    function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    //Lấy thông tin từ bảng categories
    function getCate()
    {
        $sql = "SELECT * FROM categories  order by id desc";
        return $this->db->getAll($sql);
    }

    // lấy danh mục theo loại
    function getCategoriesByType($type = []){
        $sql = "SELECT * FROM categories WHERE type = ?";
        return $this->db->getAll($sql, [$type]);
    }
    //Lấy danh mục tin tức
    function getPostCate(){
        $sql = "SELECT * FROM categories WHERE type = 'Tin tức' order by id desc";
        return $this->db->getAll($sql);
    }
    //Lấy thông tin sản phẩm theo id
    public function getIdPro($id)
    {
        $sql = "SELECT * FROM products WHERE category_id = ? LIMIT 1";
        return $this->db->getOne($sql, [$id]);
    }
    //Lấy thông tin bài viết theo id
    public function getIdPost($id)
    {
        $sql = "SELECT * FROM posts WHERE category_id = ? LIMIT 1";
        return $this->db->getOne($sql, [$id]);
    }
    //Lấy thông tin bài viết theo id
    public function getIdCate($id)
    {
        $sql = "SELECT * FROM categories WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    //Tính sản phẩm theo danh mục
    public function countProductsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) as count FROM products WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['count'];
    }
    //lấy sản phẩm theo danh mục
    public function getProductsByCategoryId($categoryId)
    {
        $sql = "SELECT * FROM products WHERE category_id = ?";
        return $this->db->getAll($sql, [$categoryId]);
    }
    //Tính bài viết theo danh mục
    public function countPostsByCategoryId($categoryId)
    {
        $sql = "SELECT COUNT(*) as count FROM posts WHERE category_id = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([$categoryId]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return (int)$row['count'];
    }
    //Lấy bài viết theo danh mục
    public function getPostsByCategoryId($categoryId)
    {
        $sql = "SELECT posts.*, categories.name AS category_name, users.full_name AS author_name
                    FROM posts
                    JOIN categories ON posts.category_id = categories.id
                    JOIN users ON posts.author_id = users.id
                    WHERE category_id = ?";
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
    //Kiểm tra khóa ngoại
    public function isForeignKey($id) {
        $query = "SELECT COUNT(*) as count FROM products WHERE category_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['count'] > 0;
    }
    public function checkForeignKey($id) {
        $query = "SELECT COUNT(*) as count FROM posts WHERE category_id = :id";
        $stmt = $this->db->prepare($query);
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        return $result['count'] > 0;
    }
    
    
}
