/**
 * 値が入っているかを判断する
 * @param  {string|number} 商品コード、商品名、単価
 * @return {boolean} 値が入っているかどうか
 */
function is_require(param)
{
    result = false;
    if(param != "")
    {
        result = true;
    }
    return result;
}

/**
 * 商品コードの文字種バリデーションを行う
 * @param  {string} item_cd
 * @return {boolean} 正規表現とマッチするかどうか
 */
function item_cd_char_type_validation(item_cd)
{
    var item_cd_regex = new RegExp("[^a-zA-Z0-9]");
    return item_cd_regex.test(item_cd);
}

/**
 * 商品コードの桁数バリデーションを行う
 * @param  {string} item_cd
 * @return {boolean} 正規表現とマッチするかどうか
 */
function item_cd_digits_validation(item_cd)
{
    var item_cd_regex = new RegExp("^[a-zA-Z0-9]{8}$");
    return item_cd_regex.test(item_cd);
}

/**
 * 商品名のバリデーションを行う
 * @param  {string} item_name
 * @return {boolean} 正規表現とマッチするかどうか
 */
function item_name_validation(item_name)
{
    var item_name_regex = new RegExp("^.{1,50}$");
    return item_name_regex.test(item_name);
}

/**
 * 単価の文字種バリデーションを行う
 * @param  {number} unitprice
 * @return {boolean} 正規表現とマッチするかどうか
 */
function unitprice_char_type_validation(unitprice)
{
    var unitprice_regex = new RegExp("[^\\d\\.]");
    return unitprice_regex.test(unitprice);
}

/**
 * 単価の桁数バリデーションを行う
 * @param  {number} unitprice
 * @return {boolean} 正規表現とマッチするかどうか
 */
function unitprice_digits_validation(unitprice)
{
    var unitprice_regex = new RegExp("^(\\d{1,12})(\\.\\d{1,3})?$");
    return unitprice_regex.test(unitprice);
}
