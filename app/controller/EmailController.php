<?php

class GetlayoutEmail
{
    public function emailcheckout($view, $data = []) /* nhận dữ liệu email trả về layout */
    {
        var_dump($data);
        ob_start();
        extract($data);
        require 'app/view/emailSend.php/' . $view . '.php';
        return ob_get_clean();
    }
}
