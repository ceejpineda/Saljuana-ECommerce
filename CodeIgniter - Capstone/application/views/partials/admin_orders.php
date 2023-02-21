<?php
foreach($orders as $order){
?>
                <tr>
                    <td><a href="admin_order_detail_page.html"><?=$order['id']?></a></td>
                    <td><?=$order['first_name'] . ' ' . $order['last_name']?></td>
                    <td><?=date_format(date_create($order['created_at']), 'Y-m-d')?></td>
                    <td><?=$order['shipping']?></td>
                    <td><?=$order['billing']?></td>
                    <td>$<?=$order['total_amount']?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="product_id" value="product_id"/>
                            <select class="form-select" name="admin_orders_update">
                                <option <?=($order['status']=='pending')?'selected':''?>>Order in process</option>
                                <option <?=($order['status']=='shipped')?'selected':''?>>Shipped</option>
                                <option <?=($order['status']=='cancelled')?'selected':''?>>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
<?php
}
?>