<?php
require_once "../models/dao/Product_dao.php";
/**
 * 商品一覧のロジック
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     - 
 * @link       -
 */
class Product_info_logic
{

    /**
     * 商品一覧の検索
     * @param object $item_list_object
     */
    public function item_search($item_list_object)
    {

        // PDOオブジェクト作成
        $item_dao = new Product_dao();

        try
        {
            // データベース接続
            $dbh = $item_dao->db_start();
            $item_list = $item_dao->item_list_select(
                                                    $dbh,
                                                    $item_list_object, 
                                                    $item_list_object->get_item_cd(),
                                                    $item_list_object->get_item_name()
                                                    );
            if(empty($item_list[0]))
            {
                $item_list_object->set_message("検索対象の商品データが存在しません。");
                return;
            }
            else
            {
                // 検索結果をセットする
                $item_form_array = array();
                foreach($item_dao->item_list_select($dbh,$item_list_object, $item_list_object->get_item_cd(), $item_list_object->get_item_name()) as $item){
                    $item_form = new Product_form();
                    $item_form->set_item_div_name($item["itemdivname"]);
                    $item_form->set_item_cd($item["itemcd"]);
                    $item_form->set_item_name($item["itemname"]);
                    $item_form->set_unitprice($item["unitprice"]);
                    array_push($item_form_array,$item_form);
                }
                $item_list_object->set_item_list($item_form_array);
            }
        }
        catch(PDOException $e)
        {
            throw $e;
        }
        $item_dao->db_close($dbh);
    }
}
