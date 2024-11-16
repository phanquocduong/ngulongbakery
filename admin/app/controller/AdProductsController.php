<?php
class AdProductsController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view

    public function __construct()
    {
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewProducts()
    {
        $this->renderview('products', $this->data);
    }
    public function viewProducts_Detail()
    {
        $this->renderview('products_detail', $this->data);
    }
    public function viewAddProducts()
    {
        $this->renderview('add_products', $this->data);
    }
    public function viewEditProducts()
    {
        $this->renderview('edit_products', $this->data);
    }
    public function delProducts($id)
    {
        $this->data['id'] = $id;
        $this->renderview('del_products', $this->data);
    }
}
?>