<?php
require_once "../models/forms/Product_form.php";

/**
 * 新規登録画面に関連したコントローラークラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     沖中  
 * @link       -
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
            // 初期表示
            case "default":
                $_SESSION["item_category"] = $regist_item_object->get_item_category_list();
                $this->show_product_register($regist_item_object);
                break;

            // 登録ボタン押下
            case  "register":
                $this->regist($regist_item_object);
                break;

            // 戻るボタン押下
            case "pageback":
                $this->click_pageback();
                break;
        }

        
        
    }
    // 商品新規登録のviewを呼び出す
    private function show_product_register($regist_item_object)
    {
            ob_start();
            require "../views/product_register.php";
            $view_product_register = ob_get_contents();
            ob_end_clean();
            echo $view_product_register;
            exit;
    }

    /*
     * 商品の新規登録処理
     * @param Product_form $regist_item_object
     */
    private function regist($regist_item_object)
    {
        //パラメータを保持
        $regist_item_object->set_item_cd($_POST["regist_item_cd"]);
        $regist_item_object->set_item_name($_POST["regist_item_name"]);
        $regist_item_object->set_item_div_cd($_POST["itemdiv_selecter"]);
        $regist_item_object->set_unitprice($_POST["regist_unitprice"]);

        $regist_logic = new Product_regist_logic();
        try
        {
            //既に登録されていた場合は商品マスタ一覧画面へ移行
            $regist_result = $regist_logic->item_regist($regist_item_object);
            if($regist_result == true)
            {
            header("Location./product_info_controller.php?btn_action=default&referer_action=reg_success",true,301);
            exit;
            }

        }

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