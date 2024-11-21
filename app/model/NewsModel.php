<?php
class NewsModel {
    private $connection;

    public function __construct() {
        // Kết nối đến cơ sở dữ liệu
        $this->connection = new mysqli('hostname', 'username', 'password', 'ngulongbakery');
        
        if ($this->connection->connect_error) {
            die("Kết nối thất bại: " . $this->connection->connect_error);
        }
    }

    public function getNews() {
        $query = "SELECT * FROM news"; // Truy vấn để lấy tất cả tin tức
        $result = $this->connection->query($query);
        
        if ($result->num_rows > 0) {
            return $result->fetch_all(MYSQLI_ASSOC); // Trả về dữ liệu dưới dạng mảng
        } else {
            return []; // Trả về mảng rỗng nếu không có dữ liệu
        }
    }
}
?>