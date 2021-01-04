<?php
require_once "../models/forms/Product_form.php";

/**
 * 新規登録画面に関連したコントローラークラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     沖中  
 * @link       ---
 */

class Product_register_controller
{
    public function product_register_btn_access()
    {
        if(!isset($_SESSION))
        {
            session_start();
        };

        $register_btn_params = $_REQUEST["btn_action"];

        $regist_item_object = new Product_form();

        switch($register_btn_params)
        {
            case "default":
                $_SESSION["item_category"] = $regist_item_object->get_item_category_list();
                $this->show_product_register($regist_item_object);
                break;
                

            case "pageback":
                $this->click_pageback();
                break;
        }

        
        
    }
    private function show_product_register()
    {
            ob_start();
            require "../views/product_register.php";
            $view_product_register = ob_get_contents();
            ob_end_clean();
            echo $view_product_register;
            exit;
    }

    private function click_pageback()
    {
        header("Location:./product_info_controller.php?btn_action=default&referer_action=reg_pageback",true,301);
        exit;
    }
}

$product_register_controller_object = new Product_register_controller;
$product_register_controller_object->product_register_btn_access();
?>