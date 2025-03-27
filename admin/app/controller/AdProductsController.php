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
        $productsModel = new AdProductsModel();
        $currentPage = isset($_GET['p']) ? (int) $_GET['p'] : 1;
        $limit = 10;
        $offset = ($currentPage - 1) * $limit;

        // Handle search
        if (isset($_POST['button_product']) && !empty($_POST['search_product'])) {
            $keyword = $_POST['search_product'];
            $products = $productsModel->searchProducts($keyword, $limit, $offset);
            $totalProducts = $productsModel->getTotalSearchResults($keyword);
        } else {
            $products = $productsModel->getProducts($limit, $offset);
            $totalProducts = $productsModel->getTotalProducts();
        }

        $totalPages = ceil($totalProducts / $limit);

        $this->data['products'] = $products;
        $this->data['totalPages'] = $totalPages;
        $this->data['currentPage'] = $currentPage;
        $this->data['searchKeyword'] = $_POST['search_product'] ?? '';

        $this->renderview('Products', $this->data);
    }
    public function viewProducts_Detail()
    {
        $this->renderview('Products_Detail', $this->data);
    }
    public function viewAddProducts()
    {
        $this->renderview('Add_Products', $this->data);
    }
    public function viewEditProducts()
    {
        $this->renderview('Edit_Products', $this->data);
    }
    public function getCategories()
    {
        return $this->category->getCate();
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
            $data['detailed_description'] = $_POST['contain_description'];
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
        if (isset($_POST['submit'])) {
            $data = [];
            $data['id'] = isset($_POST['id']) ? intval($_POST['id']) : 0;
            $data['name'] = $_POST['name'] ?? '';
            $data['price'] = $_POST['price'] ?? 0;
            $data['sale'] = $_POST['price_sale'] ?? 0;
            $data['short_description'] = $_POST['short_description'] ?? '';
            $data['detailed_description'] = $_POST['description'] ?? '';
            $data['rating'] = $_POST['rating'] ?? 0;
            $data['stock_quantity'] = $_POST['stock_quantity'] ?? 0;
            $data['sold'] = $_POST['sold'] ?? 0;
            $data['views'] = $_POST['views'] ?? 0;
            $data['tags'] = $_POST['tag'] ?? '';
            $data['status'] = $_POST['status'] ?? 0;
            $data['category_id'] = $_POST['category'] ?? 0;

            // Handle main image upload
            if (!empty($_FILES['image']['name'])) {
                $data['image'] = $_FILES['image']['name'];
                $file = '../public/upload/product/' . $data['image'];
                if (!move_uploaded_file($_FILES['image']['tmp_name'], $file)) {
                    echo '<script>alert("Không thể tải lên ảnh chính.")</script>';
                    return;
                }
            } else {
                $data['image'] = $_POST['existing_image'] ?? '';
            }

            // Handle extra images
            $extra_images = [];
            if (!empty($_FILES['ex_image']['name'][0])) {
                foreach ($_FILES['ex_image']['name'] as $key => $image) {
                    $extra_images[] = $image;
                    $fileExtra = '../public/upload/product/' . $image;
                    if (!move_uploaded_file($_FILES['ex_image']['tmp_name'][$key], $fileExtra)) {
                        echo '<script>alert("Không thể tải lên ảnh phụ.")</script>';
                        return;
                    }
                }
            } else {
                $extra_images = $_POST['existing_extra_image'] ?? [];
            }
            $data['extra_image'] = implode(',', $extra_images);
            $this->products->updatePro($data);
            echo '<script>alert("Cập nhật sản phẩm thành công")</script>';
            echo '<script>location.href="index.php?page=products"</script>';
        }
    }


    // public function delPro()
    // {
    //     // if (isset($_GET['id']) && ($_GET['id'] > 0)) {
    //     //     $id = $_GET['id'];
    //     //     $data = $this->products->getProductById($id);

    //     //     // Xoá ảnh chính
    //     //     $file = '../public/upload/product/' . $data['image'];
    //     //     if (file_exists($file)) {
    //     //         unlink($file);
    //     //     }

    //     //     // Xoá ảnh con
    //     //     $extra_images = explode(',', $data['extra_image']);
    //     //     foreach ($extra_images as $extra_image) {
    //     //         $fileExtra = '../public/upload/product/' . $extra_image;
    //     //         if (file_exists($fileExtra)) {
    //     //             unlink($fileExtra);
    //     //         }
    //     //     }

    //     //     $this->products->deletePro($id);
    //     // }
    //     // thay đổi trạng thái sản phẩm từ 1 -> 0
    //     $this->products->delPro();
    //     echo '<script>alert("Xoá sản phẩm thành công")</script>';

    //     echo '<script>location.href="index.php?page=products"</script>';
    // }

    public function delPro()
    {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $data = $this->products->getProductById($id);

            if ($data) {
                $newStatus = $data['status'] == 1 ? 0 : 1;
                $this->products->updateProductStatus($id, $newStatus);
                $statusMessage = $newStatus == 1 ? "Sản phẩm đã được hiển thị lại." : "Sản phẩm đã được ẩn.";
                echo "<script>alert('{$statusMessage}');</script>";
                echo '<script>location.href="index.php?page=products"</script>';
            } else {
                echo '<script>alert("Sản phẩm không tồn tại.");</script>';
                echo '<script>location.href="index.php?page=products"</script>';
            }
        } else {
            echo '<script>alert("ID sản phẩm không hợp lệ.");</script>';
            echo '<script>location.href="index.php?page=products"</script>';
        }
    }

    public function searchProducts()
    {
        if (isset($_POST['button_product'])) {
            $keyword = $_POST['search_product'];
        } else {
            echo "No keyword provided.";
            return;
        }

        $sql = "SELECT * FROM products WHERE name LIKE :keyword";
        $params = [':keyword' => '%' . $keyword . '%'];

        $db = new Database();
        $results = $db->getAll($sql, $params);
        $db = new Database();
        return $db->getAll($sql, $params);
    }

}
?>