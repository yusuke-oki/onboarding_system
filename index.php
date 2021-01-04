<!DOCTYPE html>

<html>
    <head>
        <meta charset='utf-8'>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>メニュー画面</title>
        <link rel="stylesheet" href="views/css/bootstrap.css" type="text/css">
    </head>
    <body>
        <div class="d-flex flex-column justify-content-center mr-auto" style="height: 100vh; text-align: center;" >
            <Form action="./controllers/product_info_controller.php" method="post" style="height: 150px;">
                <button class="col-6 h-50 mb-2 btn btn-outline-secondary btn-block btn-lg" " type="submit" name="btn_action" value="default">商品マスタメンテナンス</button>
                <input type="hidden" name="referer_action" value="default">
            </form>
            <Form action="views/product_search.php" method="post" style="height: 150px;">
                <button  class="col-6 h-50 btn btn-outline-info btn-lg" type="submit" name="btn_action">商品検索</button>
            </form>
        </div>



    <?php

    ?>
    </body>
</html>