<?php
class AdProductsController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view
    private $products;
    private $category;

    public function __construct()
    {
        require_once './app/model/AdProductsModel.php';
        require_once './app/model/CategoryModel.php';
        $this->category = new CategoryModel();
        $this->products = new AdProductsModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewProducts()
    {
        $this->data = $this->products->getProducts();
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