<?php
class AdCategoriesController
{
    private $data;
    private $cate;
    public function __construct()
    {
        require_once './app/model/CategoryModel.php';
        $this->cate = new CategoryModel();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewCategories()
    {
        $cate = new CategoryModel();
        $this->data['cate'] = $this->cate->getCate();
        $this->renderview('Categories', $this->data);
    }
    public function viewAddCategories()
    {
        $this->renderview('add_categories', $this->data);
    }
    public function viewEditCategories()
    {
        $this->renderview('edit_categories', $this->data);
    }
    public function viewCategories_Detail()
    {
        $this->renderview('Categories_detail', $this->data);
    }
}

?>