<?php
require_once "../models/dao/product_dao.php";
require_once "../models/form/Product_category_form.php";
/**
 * 商品登録のロジック
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     沖中  
 * @link       -
 */

class Product_regist_logic
{
    /**
     *商品の新規登録
     *@param object $regist_item_object
     */
    public function item_regist($regist_item_object)
    {
        $ret = false;
        $product_dao = new Product_dao();
        try
        {
            $dbh = $product_dao->db_start();
        }
        catch(PDOException $e)
        {
            $regist_item_object->set_message("DBの登録に失敗しました。");
            throw $e;
        }
        $dbh->beginTransaction();

        try
        {
            if($product_dao->get_upddatetime_for_update_by_itemcd($dbh, $regist_item_object->get_item_cd()))
            {
                // データが存在していたらロールバック
                $regist_item_object->set_message("登録対象の商品データはすでに存在します。");
                $dbh->rollBack();
            }
            else
            {
                if($product_dao->insert_item($dbh,$regist_item_object))
                {
                    $dbh->commit();
                    $ret = true;
                }
                else
                {
                    throw new Exception("insertに失敗しました。");
                }
            }

        }
        catch(Exception $e)
        {
                $regist_item_object->set_message("DBの登録に失敗しました。");
                $dbh->rollBack();
                throw $e;
        }
        finally
        {
            $product_dao->db_close($dbh);
        }
        return $ret;
    }
    

}

?>