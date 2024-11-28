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
}
?>