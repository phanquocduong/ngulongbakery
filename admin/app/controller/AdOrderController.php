<?php

use App\Model\OrderModel;

class AdOrderController
{
    private $data; // biến lưu trữ dữ liệu từ controller sang view
    private $orderModel;
    private $mailController;
    public function __construct()
    {
        require_once './app/model/OrderModel.php';
        // $this->data = new OrderModel();
        $this->orderModel = new OrderModel();
        $this->mailController = new AdMailController();
        $this->data = [];
    }
    public function renderview($view, $data = null)
    {
        $view = './app/view/' . $view . '.php';
        require_once $view;
    }

    public function viewOrder()
    {
        $this->data['orders'] = $this->orderModel->getOrder();
        $this->renderview('order', $this->data);
    }
    public function viewOrder_Detail()
    {
        $this->renderview('order_detail', $this->data);
    }
    public function confirmOder()
    {
        $checkurl = '';
        if (isset($_POST['deleteod'])) {
            $status = 'Đã hủy';
        } else {
            $status = trim($_POST['subodervip']);
        }

        $IdOder = $_POST['oderCom-id'];

        if (trim($status) == 'Đã xác nhận') {
            $checkurl = 'Mailstatuspro';
        } elseif (trim($status) == 'Đang giao hàng') {
            $checkurl = 'onwayoder';
        } elseif (trim($status) == 'Giao hàng thành công') {
            $checkurl = 'complete';
        } elseif (trim($status) == 'Đã hủy') {
            $checkurl = 'deleteoder';
        }

        /*     cập nhật trạng thái đơn hàng */
        $resus = $this->orderModel->chanceStatuspr($status, $IdOder);
        if ($resus) {
            $_SESSION['success'] = "Đơn hàng hiện $status ";

            $emailuser = $_POST['odermaildl'];;
            $checkuser = $this->mailController->statusPr($checkurl, $emailuser, $status);
            /*   $_SESSION['success'] = "Chúng tôi sẽ cố gắng liên hệ lại với bạn trong thời gian sớm nhất!";
 */
            header('Location: ./index.php?page=order_detail&id=' . $IdOder);
        } else {
            echo "  <script>
                alert('khong gui dc ')
              </script>";
            /*  $this->viewOrder(); */
        }
    }
}
