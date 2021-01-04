<?php
/**
 * 検索に使う検索商品コードと検索商品名と、
 * 検索結果を格納するDTOクラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     沖中
 * @link       -
 */
class Product_info_form
{
    /**
     * 検索フォームの商品コード
     * @var string
     */
    private $item_cd;

    /** 
     * 検索フォームの商品名
     * @var string
     */
    private $item_name;

    /**
     * 検索結果
     * @var array 
     */
    private $item_list = array();

    /**
     * メッセージ
     * @var string 
     */
    private $message = array();

    /**
     * 検索に使う商品コード
     * @param string $item_cd
     */
    public function set_item_cd($item_cd)
    {
        $this->item_cd = $item_cd;
    }
    
    /**
     * 検索に使う商品コード
     * @return $this->item_cd
     */
    public function get_item_cd()
    {
        return $this->item_cd;
    }

    /**
     * 検索に使う商品名
     * @param string $item_name
     */
    public function set_item_name($item_name)
    {
        $this->item_name = $item_name;
    }
    
    /** 
     * 検索に使う商品名
     * @return $this->item_name
     */
    public function get_item_name()
    {
        return $this->item_name;
    }

    /**
     * 検索結果
     * @param array $item_form_array
     */
    public function set_item_list($item_form_array)
    {
        $this->item_list = $item_form_array; 
    }

    /**
     * 検索結果
     * @return $this->item_list
     */
    public function get_item_list()
    {
        return $this->item_list;
    }

    /**
     * メッセージ
     * @param string $message
     */
    public function set_message($message)
    {
        $this->message[] .= $message;
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