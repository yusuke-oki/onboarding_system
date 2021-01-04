/**
 * 商品マスタ一覧画面のフォームをクリア
 */
function clear_button_click()
{
    document.getElementById("item_cd").value = "";
    document.getElementById("item_name").value = "";
};

function post_update(item_cd)
{
    const update_form = document.createElement("form");
    update_form.setAttribute("action", "../controllers/product_info_controller.php")
    update_form.setAttribute("method", "post");

    const input1 = document.createElement('input');
    input1.setAttribute("name", "item_cd");
    input1.setAttribute("value", item_cd);
    input1.setAttribute("type", "hidden");

    update_form.appendChild(input1);

    const input2 = document.createElement('input');
    input2.setAttribute("name", "btn_action");
    input2.setAttribute("value", "update");
    input2.setAttribute("type", "hidden");
    update_form.appendChild(input2);

    document.body.appendChild(update_form);

    update_form.submit();
}

function post_delete(item_cd)
{
    const delete_form = document.createElement("form");
    delete_form.setAttribute("action", "../controllers/product_info_controller.php");
    delete_form.setAttribute("method", "post");

    const input1 = document.createElement('input');
    input1.setAttribute("name", "item_cd");
    input1.setAttribute("value", item_cd);
    input1.setAttribute("type", "hidden");

    delete_form.appendChild(input1);

    const input2 = document.createElement('input');
    input2.setAttribute("name", "btn_action");
    input2.setAttribute("value", "delete");
    input2.setAttribute("type", "hidden");
    delete_form.appendChild(input2);

    document.body.appendChild(delete_form);

    delete_form.submit();
}