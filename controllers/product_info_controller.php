<?php
require_once "../models/forms/Product_category_form.php";
require_once "../models/forms/Product_form.php";
require_once "../models/forms/Product_info_form.php";
require_once "../models/logics/Product_info_logic.php";

/**
 * 商品マスタ一覧画面に関連したコントローラークラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     -
 * @link       -
 */
class Product_info_controller
{
    /**
     * イベントによる処理ディスパッチ
     */
    public function btn_access()
    {
        if(!isset($_SESSION))
        {
            session_start();
        };
        /**
         * 処理モード
         * @var string $btn_params
         */
        $btn_params = $_REQUEST["btn_action"];

        $item_list_object = new Product_info_form();

        switch($btn_params)
        {
            // 初期表示
            case "default":
                switch($_REQUEST["referer_action"])
                {
                
                    // メニューの商品マスタメンテナンスボタン押下
                    case "default":
                        $item_list_object->set_message("");
                        $this->show_item_list($item_list_object);
                        break;
                    
                        
                    // 商品登録画面の戻るボタン押下
                    case "reg_pageback":
                        $item_list_object->set_item_cd($_SESSION["search_params"]->get_item_cd());
                        $item_list_object->set_item_name($_SESSION["search_params"]->get_item_name());
                        $this->show_item_list($item_list_object);
                        break;
                }
                break;

            //検索ボタン押下
            case "search":
                $item_list_object->set_item_cd($_POST["item_cd"]);
                $item_list_object->set_item_name($_POST["item_name"]);
                $_SESSION["search_params"] = $item_list_object;
                $this->search($item_list_object);
                break;
            
            //新規登録ボタン押下
            case "register":
                $item_list_object->set_item_cd($_POST["item_cd"]);
                $item_list_object->set_item_name($_POST["item_name"]);
                $_SESSION["search_params"] = $item_list_object;
                $this->register_call();

             //戻るボタン押下
             case "pageback":
                header("Location:../index.php");
                break;
            
            //削除ボタン押下
            case"delete":
                $this->delete_call($_POST["item_cd"]);
                break;

            //更新ボタン押下    
            case "update":
                $this->update_call($_POST["item_cd"]);
                break;
        }
    }

    /**
     * 商品一覧マスタのviewを呼び出す
     * @param object $item_list_object
     */
    private function show_item_list($item_list_object)
    {
        ob_start();
        require "../views/product_info.php";
        $item_list_view = ob_get_contents();
        ob_end_clean();
        echo $item_list_view;
        exit;
    }
    /**
     * 入力されている商品コード、商品名で検索処理を行う
     * @param object $item_list_object
     */
    private function search($item_list_object)
    {
        try
        {
            $search_logic = new Product_info_logic();
            $search_logic->item_search($item_list_object);
            $item_list_object->set_message("");
        }
        catch(PDOException $e)
        {
            $item_list_object->set_message("DBの検索に失敗しました。");
        }
        $this->show_item_list($item_list_object);
    }

    private function register_call()
    {
        header("Location:./product_register_controller.php?btn_action=default&referer_action=default",true,301);
        exit;
    }

    private function update_call($item_cd)
    {
        header("Location:./product_update_controller.php?btn_action=default&referer_action=default&update_item_cd={$item_cd}",true,301 );
        exit;
    }

    private function delete_call($item_cd)
    {
        header("Location:./product_delete_controller.php?btn_action=default&referer_action=default&delete_item_cd={$item_cd}",true,301);
    }
    
}

$item_list_controller_object = new Product_info_controller;
$item_list_controller_object->btn_access();
?>
