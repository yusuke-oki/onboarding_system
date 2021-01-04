<?php
/**
 * 商品分類コードと商品分類名を格納するDTOクラス
 * @package    onboarding_system
 * @subpackage -
 * @category   -
 * @author     -
 * @link       -
 */
class Product_category{
    /**
     * 商品分類コード
     * @var string
     */
    private $div_cd;

    /**
     * 商品分類名
     * @var string
     */
    private $div_name;

    /**
     * 商品分類コード
     * @param string $divcd
     */
    public function set_div_cd($div_cd)
    {
        $this->div_cd = $div_cd;
    }

    /** 商品分類コード
     * @return string $this->divcd
     */
    public function get_div_cd()
    {
        return $this->div_cd;
    }

    /** 商品分類名
     * @param string $div_name
     */
    public function set_div_name($div_name)
    {
        $this->div_name = $div_name;
    }

    /** 商品分類名
     * @return string $this->div_name
     */
    public function get_div_name()
    {
        return $this->div_name;
    }
}
