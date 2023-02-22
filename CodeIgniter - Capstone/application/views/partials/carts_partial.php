<table class="table table-striped text-start">
                <thead>
                    <tr>
                        <th>Item</th>
                        <th>Unit Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
<?php
foreach($items as $item){
    $total = number_format($item['price']*$item['qty'], 2);
?>
                    <tr>
                        <td><?=$item['product_name']?></td>
                        <td>$<?=$item['price']?></td>
                        <td class="d-flex qty_td">
                            <form action="/products/carts/modify_cart_item/" method="post" class="modify_item_form">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <input type="hidden" name="cart_id" value="<?=$item['id']?>">
                                <input class="form-control qty_cart text-start" type="number" name="qty" value="<?=$item['qty']?>" min="0" max="99">
                            </form>
                            <a href="/products/carts/modify_cart_item/<?=$item['id']?>" type="submit" class="btn btn-danger cart_delete">Delete</a>
                        </td>
                        <td>$<?=$total?></td>
                    </tr>
<?php
}
?>
                </tbody>
            </table>
            <section class="cart_total_section">
                <h4>Total: <span class="cart_total_amount">$<?=$sum?></span></h4>
                <a class="btn btn-primary mt-3" href="/products/categories">Continue Shopping</a>
            </section>