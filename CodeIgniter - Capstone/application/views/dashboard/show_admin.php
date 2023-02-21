<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Order Detail Page)</title>
<?php $this->load->view('partials/header') ?>
</head>
<body>
<?php $this->load->view('partials/nav-admin') ?>
    <main>
        <div class="row">
            <aside class="col-sm-3 bg-light text-start p-3">
                <h3 class="mb-3">Order ID: <?=$id?></h3>
                <h4>Customer shipping info:</h4>
                <div class="p-3 pt-1">
                    <p>Name: <span class="fw-bold"><?=$first_name . ' '. $last_name?></span></p>
                    <p>Address Line 1: <span class="fw-bold"><?=$shipping['address_ship']?></span></p>
                    <p>Address Line 2: <span class="fw-bold"><?=$shipping['address2_ship']?></span></p>
                    <p>City: <span class="fw-bold"><?=$shipping['city_ship']?></span></p>
                    <p>State: <span class="fw-bold"><?=$shipping['state_ship']?></span></p>
                    <p>Zip: <span class="fw-bold"><?=$shipping['zipcode_ship']?></span></p>
                </div>
                <h4>Customer billing info:</h4>
                <div class="p-3 pt-1">
                    <p>Name: <span class="fw-bold"><?=$first_name . ' '. $last_name?></span></p>
                    <p>Address Line 1: <span class="fw-bold"><?=$billing['address_bill']?></span></p>
                    <p>Address Line 2: <span class="fw-bold"><?=$billing['address2_bill']?></span></p>
                    <p>City: <span class="fw-bold"><?=$billing['city_bill']?></span></p>
                    <p>State: <span class="fw-bold"><?=$billing['state_bill']?></span></p>
                    <p>Zip: <span class="fw-bold"><?=$billing['zipcode_bill']?></span></p>
                </div>
            </aside>
            <aside class="col-sm-9">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Item</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
<?php 
foreach($order_items as $item){
?>
                        <tr>
                            <td><?=$item['product_id']?></td>
                            <td><?=$item['name_when_ordered']?></td>
                            <td>$<?=$item['price_when_ordered']?></td>
                            <td><?=$item['qty']?></td>
                            <td>$<?=number_format(($item['price_when_ordered'] * $item['qty']),2)?></td>
                        </tr>
<?php
}
?>
                    </tbody>
                </table>
                <div class="admin_order_info_status">
                    <p class="shipped_color">Status: <span>shipped</span></p>
                    <aside>
                        <span><p>Sub total: </p><p>$29.98</p></span>
                        <span><p>Shipping: </p><p>$1.00</p></span>
                        <span><p>Total Price: </p><p>$30.98</p></span>
                    </aside>
                </div>
            </aside>
        </div>
    </main>
</body>
</html>