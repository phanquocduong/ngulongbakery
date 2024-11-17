<?php
class AdProductsModel
{
    private $db;
    public function __construct()
    {
        require_once '../app/model/database.php';
        $this->db = new Database();
    }
    public function getProducts()
    {
        $sql = "SELECT products.*, categories.name AS category_name
                FROM products
                JOIN categories ON products.category_id = categories.id ORDER BY products.id DESC";
        return $this->db->getAll($sql);
    }
    public function getProductById($id)
    {
        $sql = "SELECT * FROM products WHERE id = ?";
        return $this->db->getOne($sql, [$id]);
    }
    public function getBestSell()
    {
        $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            WHERE products.sold > 5
            ORDER BY products.sold DESC";
        return $this->db->getAll($sql);
    }
    public function stock_quantity()
    {
        $sql = "SELECT products.*, categories.name AS category_name
            FROM products
            JOIN categories ON products.category_id = categories.id
            ORDER BY products.stock_quantity DESC";
        return $this->db->getAll($sql);
    }
    public function insertPro($data)
    {
        $sql = "INSERT INTO products (name, price, sale, image, extra_image, short_description, detailed_description, rating, stock_quantity, sold, views, tags, status, category_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
        $param = [$data['name'], $data['price'], $data['sale'], $data['image'], $data['extra_image'], $data['short_description'], $data['detailed_description'], $data['rating'], $data['stock_quantity'], $data['sold'], $data['views'], $data['tags'], $data['status'], $data['category_id']];
        return $this->db->insert($sql, $param);
    }
    public function updatePro($id, $data)
    {
        $sql = "UPDATE products SET name = ?, price = ?, sale = ?, image = ?, extra_image = ?, short_description = ?, detailed_description = ?, rating = ?, stock_quantity = ?, sold = ?, views = ?, tags = ?, status = ?, category_id = ? WHERE id = ?";
        $param = [$data['name'], $data['price'], $data['sale'], $data['image'], $data['extra_image'], $data['short_description'], $data['detailed_description'], $data['rating'], $data['stock_quantity'], $data['sold'], $data['views'], $data['tags'], $data['status'], $data['category_id'], $id];
        return $this->db->update($sql, $param);
    }
    function deletePro($id)
    {
        $sql = "DELETE FROM products WHERE id = ?";
        $param = [$id];
        return $this->db->delete($sql, $param);
    }
}

?>