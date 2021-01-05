<!DOCTYPE html>
<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">   
        <title>商品マスタ新規登録</title>
        <script type="text/javascript" src="../views/js/register_validation.js"></script>
        <script type="text/javascript" src="../views/js/product_register.js"></script>
        <link rel="stylesheet" href="../views/css/bootstrap.css" type="text/css">
    </head>
    <body>
        <div class="container" style="margin-top: 100px;">
            <div class="row">
                <?php
                   echo "<p class=\"mb-3\" </p>";
                ?>
            </div>
            <form action="../controllers/product_register_controller.php" method="post">
                <div class="form-group">
                    <div class="row">  
                        <label for="item_cd" class="col-2">商品コード</label>
                        <input class="ms-5 col-3" type="text" name="item_cd" id="item_cd" >
                    </div>
                    <div class="row mt-5">
                        <label for="item_name" class="col-2">商品名</label>
                        <input class="ms-5 col-8" type="text" name="item_name" id="item_name" >
                    </div>
                    <div class="row mt-5">
                        <label for="itemdiv_selector" class="col-2">商品分類</label>
                        <select name="itemdiv_selector" size=1 id="itemdiv_selector" class="ms-5 col-5"></select>
                    </div>
                    <div class="row mt-5">
                        <label for="unit_price" class="col-2">商品単価</label>
                        <input class="ms-5 col-3" type="text" name="unit_price" id="unit_price">
                        <div class="col-1">円</div>
                    </div>
                    <div class="d-flex row mt-5 justify-content-end  ">
                        <button class="col-2 btn btn-outline-success" name="btn_action" value="register" type="submit" onClick ="return regist_check()">登録
                        <button class="col-2 ms-5 btn btn-outline-secondary" name="btn_action" value="pageback" type="submit">戻る
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>
        