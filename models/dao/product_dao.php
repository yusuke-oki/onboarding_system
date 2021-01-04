<?php
require_once "Data_access_dao.php";
/**
 * 商品一覧テーブルのDAOクラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     -
 * @link       -
 */
class Product_dao extends Data_access
{
    /**
     * 商品一覧を検索する
     * @param object $dbh
     * @param object $item_list_object
     * @return array
     */
    public function item_list_select($dbh, $item_list_object, $item_cd, $item_name)
    {
                
        // SQL文の作成
        $sql = "";
        $sql .= "SELECT div.itemdivname";
        $sql .= "     , mst.itemcd";
        $sql .= "     , mst.itemname";
        $sql .= "     , mst.unitprice";
        $sql .= "  FROM tblitemmst AS mst"; 
        $sql .= " INNER JOIN tblitemdivmst AS div"; 
        $sql .= "    ON mst.itemdivcd = div.itemdivcd"; 
        $sql .= " WHERE 1 = 1 ";
        
        // 商品コードがある場合のWHERE句作成
        if(!$item_cd == null){
            $sql .= "AND mst.itemcd = :itemcd ";
        }

        // 商品名がある場合のWHERE句作成
        if(!$item_name == null){
                $sql .= "AND mst.itemname LIKE :itemname";
        }

        $sql .= " ORDER BY div.itemdivcd, mst.itemcd";

        // SQL文の実行準備
        $prepare = $dbh->prepare($sql);

        // 変数のバインド
        if(!$item_cd == null){
            $prepare->bindvalue(':itemcd', $item_cd, PDO::PARAM_STR);
        }
        if(!$item_name == null){
            $prepare->bindValue(':itemname','%'.$item_name.'%', PDO::PARAM_STR);
        }

        // SQL文実行
        $prepare->execute();

        // 検索結果の取得
        return $prepare->fetchALL(PDO::FETCH_NAMED);
    }

    /**
     * 商品の新規登録を行う
     * @param object $dbh
     * @param object $regist_item_object
     */
    public function insert_item($dbh, $regist_item_object)
    {
        // データが存在していない場合の処理
        // SQL文の作成
        $sql = "";
        $sql .= "INSERT INTO tblitemmst";
        $sql .= "            (";
        $sql .= "            itemcd";
        $sql .= "          , itemname";
        $sql .= "          , itemdivcd";
        $sql .= "          , unitprice";
        $sql .= "          , regdatetime";
        $sql .= "          , regpersoncd";
        $sql .= "          , upddatetime";
        $sql .= "          , updpersoncd";
        $sql .= "          , delflg";
        $sql .= "          , deldatetime";
        $sql .= "          , delpersoncd";
        $sql .= "            )";
        $sql .= " VALUES ";
        $sql .= "             (";
        $sql .= "            :itemcd";
        $sql .= "          , :itemname";
        $sql .= "          , :itemdivcd";
        $sql .= "          , :unitprice";
        $sql .= "          , CURRENT_TIMESTAMP";
        $sql .= "          , :regpersoncd";
        $sql .= "          , CURRENT_TIMESTAMP";
        $sql .= "          , :updpersoncd";
        $sql .= "          , 0";
        $sql .= "          , null";
        $sql .= "          , null";
        $sql .= "            )";
        
        // SQL文の実行準備
        $prepare = $dbh->prepare($sql);

        // パラメータをバインドする
        $prepare->bindvalue(':itemcd', $regist_item_object->get_item_cd(), PDO::PARAM_STR);
        $prepare->bindvalue(':itemname', $regist_item_object->get_item_name(), PDO::PARAM_STR);
        $prepare->bindvalue(':itemdivcd', $regist_item_object->get_item_div_cd(), PDO::PARAM_STR);
        $prepare->bindvalue(':unitprice', $regist_item_object->get_unitprice(), PDO::PARAM_INT);
        $prepare->bindvalue(':regpersoncd', self::PERSON, PDO::PARAM_STR);
        $prepare->bindvalue(':updpersoncd', self::PERSON, PDO::PARAM_STR);

        // SQL文の実行
        return $prepare->execute();
    }

    /**
     * 商品コードで商品マスタの更新日時を検索
     * @param object $dbh
     * @param string $item_cd
     * @return timestamp|FALSE $updatetime
     */
    public function get_upddatetime_for_update_by_itemcd($dbh, $item_cd)
    {
        $sql = "";
        $sql .= "SELECT upddatetime";
        $sql .= "  FROM tblitemmst";
        $sql .= " WHERE itemcd = :regist_item_cd";
        $sql .= "   FOR UPDATE";
        $prepare = $dbh->prepare($sql);

        // 商品コードをバインドする
        $prepare->bindValue(':regist_item_cd', $item_cd, PDO::PARAM_STR);

        // SQL文の実行
        $prepare->execute();

        return $prepare->fetch();
    }

    /**
     * 商品コードで削除、更新対象のデータを検索
     * @param object $dbh
     * @param string $item_cd
     * @return array $prepare->fetch()
     */
    public function select_item_by_item_cd($dbh, $item_cd)
    {
        $sql = "";
        $sql .= "SELECT mst.itemcd";
        $sql .= "     , mst.itemname";
        $sql .= "     , div.itemdivname";
        $sql .= "     , mst.unitprice";
        $sql .= "     , mst.upddatetime";
        $sql .= "     , mst.itemdivcd";
        $sql .= "  FROM tblitemmst AS mst"; 
        $sql .= " INNER JOIN tblitemdivmst AS div"; 
        $sql .= "    ON mst.itemdivcd = div.itemdivcd"; 
        $sql .= " WHERE mst.itemcd = :itemcd ";

        $prepare = $dbh->prepare($sql);

        $prepare->bindvalue(':itemcd', $item_cd, PDO::PARAM_STR);
        $prepare->execute();
        return $prepare->fetch();
    }

    /**
     * 商品コードと合致するデータを削除
     * @param object $dbh
     * @param object $delete_item_object
     */
    public function delete_item($dbh, $delete_item_object)
    {
        $sql = "";
        $sql .= "DELETE FROM tblitemmst";
        $sql .= " WHERE itemcd = :itemcd";

        $prepare = $dbh->prepare($sql);

        $prepare->bindvalue(':itemcd', $delete_item_object->get_item_cd(), PDO::PARAM_STR);
        $prepare->execute();
    }

    /**
     * 商品の更新を行う
     * @param object $dbh
     * @param object $update_item_object
     */
    public function update_item($dbh, $update_item_object)
    {
        $sql = "";
        $sql .= "UPDATE tblitemmst";
        $sql .= "   SET itemname = :itemname";
        $sql .= "     , itemdivcd = :itemdivcd";
        $sql .= "     , unitprice = :unitprice";
        $sql .= "     , upddatetime = CURRENT_TIMESTAMP";
        $sql .= "     , updpersoncd = :updpersoncd";
        $sql .= "     , delflg = :delflg ";
        $sql .= "     , deldatetime = :deldatetime";
        $sql .= "     , delpersoncd = :delpersoncd";
        $sql .= " WHERE itemcd = :itemcd";

        // SQLの実行準備
        $prepare = $dbh->prepare($sql);

        // パラメータをバインドする
        $prepare->bindvalue(':itemname', $update_item_object->get_item_name(), PDO::PARAM_STR);
        $prepare->bindvalue(':itemdivcd', $update_item_object->get_item_div_cd(), PDO::PARAM_STR);
        $prepare->bindvalue(':unitprice', $update_item_object->get_unitprice(), PDO::PARAM_STR);
        $prepare->bindvalue(':updpersoncd', self::PERSON, PDO::PARAM_STR);
        $prepare->bindvalue(':delflg', 0, PDO::PARAM_STR);
        $prepare->bindvalue(':deldatetime', null);
        $prepare->bindvalue(':delpersoncd', null );
        $prepare->bindvalue(':itemcd', $update_item_object->get_item_cd(), PDO::PARAM_STR);
    
        $prepare->execute();
    }

    /**
     * 商品分類コードと商品名に合致するデータの取得
     * @param object $dbh
     * @param object $user_item_object
     * @return array
     */
    public function user_item_select($dbh, $user_item_object)
    {
        // SQL文の作成
        $sql = "";
        $sql .= "SELECT div.itemdivname";
        $sql .= "     , mst.itemcd";
        $sql .= "     , mst.itemname";
        $sql .= "     , mst.unitprice";
        $sql .= "  FROM tblitemmst AS mst"; 
        $sql .= " INNER JOIN tblitemdivmst AS div"; 
        $sql .= "    ON mst.itemdivcd = div.itemdivcd"; 
        $sql .= " WHERE 1 = 1 ";
        
        // 商品分類コードがある場合のWHERE句作成
        if(!$user_item_object->get_item_div_cd() == null){
            $sql .= "AND mst.itemdivcd = :itemdivcd ";
        }

        // 商品名がある場合のWHERE句作成
        if(!$user_item_object->get_item_name() == null){
                $sql .= "AND mst.itemname LIKE :itemname";
        }

        // ソートするためのorder句
        $sql .= " ORDER BY div.itemdivcd, mst.itemcd";

        // SQL文の実行準備
        $prepare = $dbh->prepare($sql);

        // 変数のバインド
        if( ! $user_item_object->get_item_div_cd() == null){
            $prepare->bindvalue(':itemdivcd', $user_item_object->get_item_div_cd(), PDO::PARAM_STR);
        }
        if( ! $user_item_object->get_item_name() == null){
            $prepare->bindValue(':itemname','%'.$user_item_object->get_item_name().'%', PDO::PARAM_STR);
        }

        // SQL文実行
        $prepare->execute();


        // 検索結果の取得
        return $prepare->fetchALL(PDO::FETCH_NAMED);
    }
}