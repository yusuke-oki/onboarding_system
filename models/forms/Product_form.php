<?php
/**
 * 商品情報と商品分類を格納するDTOクラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     -
 * @link       -
 */
class Product_form
{
    /** 
     * 商品アイテムコード
     * @var string 
     */
    private $item_cd;

    /**
     * 商品名
     *  @var string
     */
    private $item_name;

    /**
     * 商品分類コード
     *  @var string 
     */
    private $item_div_cd;

    /**
     * 商品分類名
     *  @var string 
     */
    private $item_div_name;

    /**
     * 単価
     * @var double 
     */
    private $unitprice;

    /**
     * 登録日時
     * @var int 
     */
    private $regdatetime;

    /**
     * 更新日時
     * @var int
     */
    private $upddatetime;

    /**
     * 削除フラグ
     * @var string 
     */
    private $delflg;

    /**
     * 商品分類マスタのリスト
     * @var array
     */
    private $item_category_list = array();

    /**
     * メッセージ
     * @var string 
     */
    private $message;


    /** 
     * 商品コード
     * @param string $item_cd
     */
    public function set_item_cd($item_cd)
    {
        $this->item_cd = $item_cd;
    }

    /**
     * 商品コード
     * @return string $this->item_cd
     */
    public function get_item_cd()
    {
        return $this->item_cd;
    }

    /**
     * 商品名
     * @param string $item_name
     */
    public function set_item_name($item_name)
    {
        $this->item_name = $item_name;
    }

    /**
     * 商品名
     * @return string $this->item_name
     */
    public function get_item_name()
    {
        return $this->item_name;
    }
    
    /**
     * 商品分類コード
     * @param string $item_div_cd
     */
    public function set_item_div_cd($item_div_cd)
    {
        $this->item_div_cd = $item_div_cd;
    }
    
    /**
     * 商品分類コード
     * @return string $this->item_div_cd
     */
    public function get_item_div_cd()
    {
        return $this->item_div_cd;
    }

    /**
     * 商品分類名
     * @param string $item_div_name
     */
    public function set_item_div_name($item_div_name)
    {
        $this->item_div_name = $item_div_name;
    }
    
    /**
     * 商品分類名
     * @return string $this->item_div_name
     */
    public function get_item_div_name()
    {
        return $this->item_div_name;
    }

    /**
     * 単価
     * @param double $unitprice
     */
    public function set_unitprice($unitprice)
    {
        $this->unitprice = $unitprice;
    }
    
    /**
     * 単価
     * @return double $this->unitprice
     */
    public function get_unitprice()
    {
        return $this->unitprice;
    }
    
    /**
     * 登録日時
     * @param int $regdatetime
     */
    public function set_regdatetime($regdatetime)
    {
        $this->regdatetime = $regdatetime;
    }
    
    /**
     * 登録日時
     * @return int $this->regdatetime
     */
    public function get_regdatetime()
    {
        return $this->regdatetime;
    }

    /**
     * 更新日時
     * @param int $upddatetime
     */
    public function set_upddatetime($upddatetime)
    {
        $this->upddatetime = $upddatetime;
    }
    
    /**
     * 更新日時
     * @return int $this->upddatetime
     */
    public function get_upddatetime()
    {
        return $this->upddatetime;
    }

    /**
     * 削除フラグ
     * @param string $delflg
     */
    public function set_delflg($delflg)
    {
        $this->delflg = $delflg;
    }
    
    /**
     * 削除フラグ
     * @return string- $this->delflg
     */
    public function get_delflg()
    {
        return $this->delflg;
    }

    /**
     * 商品分類マスタ
     * @param array $item_category_array
     */
    public function set_item_category_list($item_category_array)
    {
        $this->item_category_list = $item_category_array;
    }
    
    /**
     * 商品分類マスタ
     * @return array $item_category_array
     */
    public function get_item_category_list()
    {
        return $this->item_category_list;
    }

    /**
     * メッセージ
     * @param string $message
     */
    public function set_message($message)
    {
        $this->message = $message;
    }
    
    /**
     * メッセージ
     * @return string $message
     */
    public function get_message()
    {
        return $this->message;
    }
}