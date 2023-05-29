<table class="admin_orders_table table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Shipping Address</th>
                    <th>Billing Address</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach($orders as $order){
?>
                <tr>
                    <td><a class="btn btn-outline-secondary" href="/dashboard/orders/show/<?=$order['id']?>"><?=$order['id']?></a></td>
                    <td><?=$order['first_name'] . ' ' . $order['last_name']?></td>
                    <td><?=date_format(date_create($order['created_at']), 'Y-m-d')?></td>
                    <td><?=$order['shipping']?></td>
                    <td><?=$order['billing']?></td>
                    <td>$<?=$order['total_amount']?></td>
                    <td>
                        <form action="/dashboard/orders/update_status" method="post" class="update_status_form">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input type="hidden" name="order_id" value="<?=$order['id']?>"/>
                            <select class="form-select status" name="admin_orders_status">
                                <option value="1" <?=($order['status']=='pending')?'selected':''?>>Order in process</option>
                                <option value="2" <?=($order['status']=='shipped')?'selected':''?>>Shipped</option>
                                <option value="3" <?=($order['status']=='cancelled')?'selected':''?>>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
        <section class="pagination">
<?php for($page = 1; $page<=$pages; $page++)
{
?>
                <input type="submit" value="<?=$page?>" class="submit_search btn btn-secondary mx-2">
<?php 
}
?>
        </section>