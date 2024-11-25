<?php
class AdOrderController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view

    public function __construct()
    {
        require_once './app/model/OrderModel.php';
        $this->data = new OrderModel();
        // $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewOrder()
    {
        $this->data = $this->data->getOrder();
        $this->renderview('order', $this->data);
    }
    public function viewOrder_Detail()
    {
        $this->renderview('order_detail', $this->data);
    }
    public function searchOrder()
    {
        if (isset($_POST['button_order'])) {
            $keyword = $_POST['search_order'];
        } else {
            echo "No keyword provided.";
            return;
        }
    
        $sql = "SELECT * FROM orders WHERE customer LIKE :keyword";
        $params = [':keyword' => '%' . $keyword . '%'];
    
        $db = new Database(); // Ensure this uses your Database class
        $results = $db->getAll($sql, $params);
        $db = new Database();
        return $db->getAll($sql, $params);
    }
}
?>