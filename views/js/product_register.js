/**
 * 新規登録時のバリデーション
 * @return {boolean} 新規登録を行うかどうか
 */
function regist_check()
{
    /**
     * 商品コード
     * @var {string}
     */
    var item_cd = document.getElementById("item_cd").value;
   

    /**
     * 商品名
     * @var {string}
     */
    var item_name = document.getElementById("item_name").value;

    /**
     * 単価
     * @var {number}
     */
    var unitprice = document.getElementById("unit_price").value;
    
    /**
     * エラーメッセージを保持する配列
     * @var {array}
     */
    var error_messages = [];

    // /**
    //  * 商品登録マスタ画面のメッセージ
    //  * @var {string}
    //  */
    // var register_message = document.getElementById("register_message");

    // // 登録マスタ画面のメッセージ領域に文字が入っていたら空白にする
    // if(register_message.innerHTML)
    // {
    //     register_message.innerHTML = "";
    // }

    // 商品コードの入力チェックを行う
    if(!is_require(item_cd))
    {
        error_messages.push("商品コードは必須です。");
    }
    else if(item_cd_char_type_validation(item_cd))
    {
            error_messages.push("商品コードは半角英数で入力してください。");
    }
    else if(!item_cd_digits_validation(item_cd))
    {
            error_messages.push("商品コードは8桁で入力してください。");
    }
   
    // 商品名の入力チェックを行う
    if(!is_require(item_name))
    {
        error_messages.push("商品名は必須です。");
    }
    else if(!item_name_validation(item_name))
    {
        error_messages.push("商品名は50文字以下で入力してください。");
    }

    // 単価の入力チェックを行う
    if(!is_require(unitprice))
    {
        error_messages.push("単価は必須です。");
    }
    else if(unitprice_char_type_validation(unitprice))
    {
        error_messages.push("単価は半角数字で入力してください。");
    }
    else if(!unitprice_digits_validation(unitprice))
    {
        error_messages.push("単価は整数12桁以下、小数3桁以下で入力してください。");
    }

    
    // エラーメッセージが存在するかどうか調べる
    if(error_messages == "")
    {
        return confirm("登録します。\nよろしいですか？");
    }
    else
    {
        // エラーメッセージを改行で結合してアラートポップアップで表示する
        var alert_message = error_messages.join("\n")
        alert(alert_message);
        return false;
    }
}

