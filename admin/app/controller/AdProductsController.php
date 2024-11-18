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

    public function addPro()
    {
        if (isset($_POST['submit'])) {
            $data = [];
            $data['name'] = $_POST['name'];
            $data['price'] = $_POST['price'];
            $data['sale'] = $_POST['price_sale'];
            $data['image'] = $_FILES['image1']['name'];

            $extra_images = [];
            if (!empty($_FILES['image2']['name'])) {
                $extra_images[] = $_FILES['image2']['name'];
            }
            if (!empty($_FILES['image3']['name'])) {
                $extra_images[] = $_FILES['image3']['name'];
            }
            if (!empty($_FILES['image4']['name'])) {
                $extra_images[] = $_FILES['image4']['name'];
            }
            $data['extra_image'] = implode(',', $extra_images);

            $data['short_description'] = $_POST['short_description'];
            $data['detailed_description'] = $_POST['description'];
            $data['rating'] = $_POST['rating'];
            $data['stock_quantity'] = $_POST['stock_quantity'];
            $data['sold'] = $_POST['sold'];
            $data['views'] = $_POST['views'];
            $data['tags'] = $_POST['tag'];
            $data['status'] = $_POST['status'];
            $data['category_id'] = $_POST['category'];

            // Upload ảnh chính
            $file = '../public/upload/product/' . $data['image'];
            if (!move_uploaded_file($_FILES['image1']['tmp_name'], $file)) {
                echo '<script>alert("Không thể tải lên ảnh chính.")</script>';
                return;
            }

            // Upload các ảnh phụ
            if (!empty($_FILES['image2']['tmp_name'])) {
                $fileA = '../public/upload/product/' . $_FILES['image2']['name'];
                if (!move_uploaded_file($_FILES['image2']['tmp_name'], $fileA)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 1.")</script>';
                    return;
                }
            }
            if (!empty($_FILES['image3']['tmp_name'])) {
                $fileB = '../public/upload/product/' . $_FILES['image3']['name'];
                if (!move_uploaded_file($_FILES['image3']['tmp_name'], $fileB)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 2.")</script>';
                    return;
                }
            }
            if (!empty($_FILES['image4']['tmp_name'])) {
                $fileC = '../public/upload/product/' . $_FILES['image4']['name'];
                if (!move_uploaded_file($_FILES['image4']['tmp_name'], $fileC)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 3.")</script>';
                    return;
                }
            }

            $result = $this->products->insertPro($data);
            if ($result) {
                echo '<script>alert("Thêm sản phẩm thành công")</script>';
                echo '<script>location.href="index.php?page=products"</script>';
            } else {
                echo '<script>alert("Lỗi khi thêm sản phẩm vào cơ sở dữ liệu.")</script>';
            }
        }
    }

       
    public function editPro()
    {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $this->data['listCate'] = $this->category->getCate();
            $this->data['listPro'] = $this->products->getProductById($id);
            $this->renderview('edit_products', $this->data);
        }
    
        if (isset($_POST['submit'])) {
            $id = $_GET['id'];
            $data = [];
            $data['name'] = $_POST['name'];
            $data['price'] = $_POST['price'];
            $data['sale'] = $_POST['price_sale'];
            $data['image'] = $_FILES['image1']['name'];
    
            $extra_images = [];
            if (!empty($_FILES['image2']['name'])) {
                $extra_images[] = $_FILES['image2']['name'];
            }
            if (!empty($_FILES['image3']['name'])) {
                $extra_images[] = $_FILES['image3']['name'];
            }
            if (!empty($_FILES['image4']['name'])) {
                $extra_images[] = $_FILES['image4']['name'];
            }
            $data['extra_image1'] = $extra_images[0] ?? null;
            $data['extra_image2'] = $extra_images[1] ?? null;
            $data['extra_image3'] = $extra_images[2] ?? null;
    
            $data['short_description'] = $_POST['short_description'];
            $data['detailed_description'] = $_POST['description'];
            $data['rating'] = $_POST['rating'];
            $data['stock_quantity'] = $_POST['stock_quantity'];
            $data['sold'] = $_POST['sold'];
            $data['views'] = $_POST['views'];
            $data['tags'] = $_POST['tag'];
            $data['status'] = $_POST['status'];
            $data['category_id'] = $_POST['category'];
    
            // Upload ảnh chính
            $file = '../public/upload/product/' . $data['image'];
            if (!move_uploaded_file($_FILES['image1']['tmp_name'], $file)) {
                echo '<script>alert("Không thể tải lên ảnh chính.")</script>';
                return;
            }
    
            // Upload các ảnh phụ
            if (!empty($_FILES['image2']['tmp_name'])) {
                $fileA = '../public/upload/product/' . $_FILES['image2']['name'];
                if (!move_uploaded_file($_FILES['image2']['tmp_name'], $fileA)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 1.")</script>';
                    return;
                }
            }
            if (!empty($_FILES['image3']['tmp_name'])) {
                $fileB = '../public/upload/product/' . $_FILES['image3']['name'];
                if (!move_uploaded_file($_FILES['image3']['tmp_name'], $fileB)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 2.")</script>';
                    return;
                }
            }
            if (!empty($_FILES['image4']['tmp_name'])) {
                $fileC = '../public/upload/product/' . $_FILES['image4']['name'];
                if (!move_uploaded_file($_FILES['image4']['tmp_name'], $fileC)) {
                    echo '<script>alert("Không thể tải lên ảnh phụ 3.")</script>';
                    return;
                }
            }
    
            $result = $this->products->updatePro($id,$data);
            if ($result) {
                echo '<script>alert("Đã cập nhật thành công!")</script>';
                echo '<script>location.href="index.php?page=products"</script>';
            } else {
                echo '<script>alert("Lỗi khi thêm sản phẩm vào cơ sở dữ liệu.")</script>';
            }
        }
    }



    public function delPro()
    {
        if (isset($_GET['id']) && ($_GET['id'] > 0)) {
            $id = $_GET['id'];
            $data = $this->products->getProductById($id);
    
            // Xoá ảnh chính
            $file = '../public/upload/product/' . $data['image'];
            if (file_exists($file)) {
                unlink($file);
            }
    
            // Xoá ảnh con
            $extra_images = explode(',', $data['extra_image']);
            foreach ($extra_images as $extra_image) {
                $fileExtra = '../public/upload/product/' . $extra_image;
                if (file_exists($fileExtra)) {
                    unlink($fileExtra);
                }
            }
    
            $this->products->deletePro($id);
        }
        echo '<script>location.href="index.php?page=products"</script>';
    }
}
?>