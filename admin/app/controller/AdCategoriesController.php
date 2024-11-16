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
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $editcate = $this->cate->getIdCate($id);
            if (is_array($editcate)) {
                $this->data['editcate'] = $editcate;
                $this->renderview('edit_categories', $this->data);
            } else {
                echo "Not found....";
            }
    }
    public function viewCategories_Detail()
    {
        $id = isset($_GET['id']) ? $_GET['id'] : 0;
            $procate = $this->cate->getIdPro($id);

            if (is_array($procate)) {
                $this->data['procate'] = $procate;
                $this->renderview('Categories_detail', $this->data);
            } else {
                echo "Not found....";
            }
    }
}

?>