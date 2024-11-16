<?php
class AdCategoriesController
{
    private $data;

    public function __construct()
    {
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewCategories()
    {
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