<?php

class GetlayoutEmail
{
    public function emailcheckout($view, $data = []) /* nhận dữ liệu email trả về layout */
    {
        var_dump($data);
        ob_start();
        extract($data);
        require 'app/view/email_Send.php/' . $view . '.php';
        ob_get_clean();
        require 'app/view/email_Send.php/layoutmail.php';
    }
}
