<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Dashboard Orders)</title>
    <?php $this->load->view('partials/header') ?>
    <script>
        $(document).ready(function(){

            /*  Submitting of forms will redirect to specified page based on action attribute    */
            $(document).on("submit", "#search, .update_status_form", function(){
                var form = $(this);
                $.post(form.attr('action'),form.serialize(), function(res){
                    $('.paginated').html(res);
                });
                return false;
            });

            $(document).on("change keyup", "#order_search, #status_select", function(){
                $('.form_admin_orders').submit();
            })
            /**********************************************/

            $('.submit_search').click(function(){
                $('#page').val($(this).val());
            })

            $(document).on('click', '.submit_search', function(){
                $('#page').val($(this).val());
                $("#search").submit();
            })

            $(document).on('change', '.status', function(){;
                $(this).parent().submit();
            })

        });
    </script>
</head>
<body>
<?php $this->load->view('partials/nav-admin') ?>

    <main>
        <p class="message_admin_orders"></p>
        <form class="form_admin_orders" action="/dashboard/orders/do_search" method="post" id="search">
            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
            <input type="hidden" name="page" value="1" id="page">
            <div class="d-flex justify-content-between">
                <input id="order_search" class="form-control w-25" type="search" name="admin_orders_search" placeholder="search" />
                <select id="status_select" name="admin_orders_status" class="form-select w-25">
                    <option value="0">Show All</option>
                    <option value="pending">Order in process</option>
                    <option value="shipped">Shipped</option>
                    <option value="cancelled">Cancelled</option>
                </select>
            </div>
        </form>
        <div class="paginated">
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
        </div>
    </main>
</body>
</html>