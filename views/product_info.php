<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
        <title>商品マスタ一覧</title>
        <script type="text/javascript" src="../views/js/product_info.js"></script>
        <link rel="stylesheet" href="../views/css/bootstrap.css" type="text/css">
    </head>
    <body>
        
        <form action="../controllers/Product_info_controller.php" method="post" class="col-12 mx-auto mt-5 ;">
            <div class="col-7  mx-auto" style="height: 180px;">
                <div class="row">
                    <p class="mb-4">
                    <!-- item_list_objectがあるかを調べる -->
                    <?php if(isset($item_list_object))
                        {
                            $item_search_code = $item_list_object->get_item_cd(); 
                            $item_search_name = $item_list_object->get_item_name();
                        };
                    ?>  
                        <label for="item_cd">商品コード</label>
                        <input class="ms-2" type="text" name="item_cd" id="item_cd" class="code" 
                        value=<?php if(isset($item_search_code)){echo "\"". htmlspecialchars($item_search_code) ."\"";}else{echo "";}; ?>>
                    </p>
                </div>
                <div class="col-12">
                    <label for="item_name">商品名</label>
                    <input class="col-10 ms-4"type="text" name="item_name" id="item_name" class="name" 
                    value=<?php if(isset($item_search_name)){echo "\"". htmlspecialchars($item_search_name) ."\"" ;}else{echo "";}; ?>>
                </div>
                <div class="d-flex col-6 mt-3 justify-content-between btn"  style="height: 70px; margin-left: 64px;">
                    <button class="col-4 h100 btn btn-outline-primary" name="btn_action" value="search" type="submit">検索</button>
                    <button class="col-4 h100 btn btn-outline-primary" type="button" onclick="clear_button_click()">クリア</button>
                </div>
            </div>
            <hr class="col-11 mx-auto border border-dark">
        
            <div class="col-11 mx-auto">
                <div class="message_box">
                <?php
                    // 商品マスタ一覧画面のメッセージ
                    if($item_list_object->get_message()){
                        foreach($item_list_object->get_message() as $list_message){
                            echo "<p class=\"text-danger\">".$list_message."</p>";
                        }
                    }       
                ?>
                </div>
                <table class="table">
                    <thead>
                    <tr>
                        <th class="col">商品分類</th> 
                        <th class="col">商品コード</th>
                        <th class="col">商品名</th>
                        <th class="col">単価</th>
                        <th class="col px-3">更新</th>
                        <th class="col px-3 ">削除</th>
                    </tr>
                    </thead>
                    <?php
                        if(isset($item_list_object))
                            {   
                                // 商品一覧を取得し、table要素で出力する
                                foreach($item_list_object->get_item_list() as $item_lists)
                                {
                                // 商品コードをシングルクォーテーションで囲む
                                $item_cd = "'{$item_lists->get_item_cd()}'";
                                echo
                                "
                                    <tr>
                                        <td class=\"item_div_name\">{$item_lists->get_item_div_name()}</td>
                                        <td class=\"item_cd\">{$item_lists->get_item_cd()}</td>
                                        <td class=\"item_name\">".htmlspecialchars($item_lists->get_item_name(),ENT_QUOTES,'UTF-8')."</td>
                                        <td class=\"unitprice\">".number_format($item_lists->get_unitprice(),3)."円</td>
                                        <td class=\"upd_btn\">
                                            <button class=\"btn btn-success \" type=\"button\" onclick=\"post_update($item_cd)\">更新
                                        </td>
                                        <td class=\"del_btn\">
                                            <button class=\"btn btn-danger\" type=\"button\" onclick=\"post_delete($item_cd)\">削除
                                        </td>
                                    </tr>
                                ";
                            }
                        };
                    ?>
                </table>
            </div>
            <div class="col-12">
                <div class="d-flex col-5 mt-3 justify-content-around  ms-auto" style="height: 60px;">
                    <button type="submit" name="btn_action" value="register" class="col-4 btn btn-outline-success">新規登録</button>
                    <button type="submit" name="btn_action" value="pageback" class="col-4 btn btn-outline-secondary">戻る</button>
                </div> 
            </div>
        </form>
     
    </body>
</html>
