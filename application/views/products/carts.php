<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Carts Page) Shopping Cart | Saljuana</title>
    <script type="text/javascript" src="https://js.stripe.com/v3/"></script>    
    <script src="https://checkout.stripe.com/checkout.js"></script>
    <script src="<?= base_url('assets/js/carts_stripe.js') ?>" defer></script>
<?php $this->load->view('partials/header') ?>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="nav" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">Saljuana</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            </div>
            <div>
                <a href="/products/carts" class="btn logoff" type="submit">Shopping Cart (<span id="cart_items"><?=$count?></span>)</a>
                <a href="/users/logout" class="btn logoff" type="submit">Log-Off</a>
            </div>
        </div>
    </nav>
    <main class="row d-flex flex-row">
        <section class="cart_table_section col-sm-6 partialized">
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
    $total = (float)$item['price']*$item['qty'];
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
                <h4>Total: <span class="cart_total_amount">$<span id="all_total"><?=$sum?></span></span></h4>
                <a class="btn btn-primary mt-3" href="/products/carts/order_history">Order History</a>
                <a class="btn btn-primary mt-3" href="/products/categories">Continue Shopping</a>
            </section>
        </section>
        <section class="cart_billing_section col-sm-6 p-4">
            <form class="d-flex flex-column" action="/products/carts/finalize_order" method="post" id="paymentForm">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <div class="row d-flex">
                    <div class="d-flex flex-column col-sm-6">
                        <h2>Shipping Information</h2>
                        <label class="form-label">First Name: </label>
                        <input class="form-control" type="text" name="first_name_ship"/>
                        <label class="form-label">Last Name: </label>
                        <input class="form-control" type="text" name="last_name_ship"/>
                        <label class="form-label">Address: </label>
                        <input class="form-control" type="text" name="address_ship"/>
                        <label class="form-label">Address 2: </label>
                        <input class="form-control" type="text" name="address2_ship"/>
                        <label class="form-label">City: </label>
                        <input class="form-control" type="text" name="city_ship"/>
                        <label class="form-label">State: </label>
                        <input class="form-control" type="text" name="state_ship"/>
                        <label class="form-label">Zipcode: </label>
                        <input class="form-control" type="number" name="zipcode_ship"/>
                    </div>
                    <div class="d-flex flex-column col-sm-6">
                        <h2>Billing Information</h2>
                        <label class="form-label">First Name: </label>
                        <input class="form-control" type="text" name="first_name_bill"/>
                        <label class="form-label">Last Name: </label>
                        <input class="form-control" type="text" name="last_name_bill"/>
                        <label class="form-label">Address: </label>
                        <input class="form-control" type="text" name="address_bill"/>
                        <label class="form-label">Address 2: </label>
                        <input class="form-control" type="text" name="address2_bill"/>
                        <label class="form-label">City: </label>
                        <input class="form-control" type="text" name="city_bill"/>
                        <label class="form-label">State: </label>
                        <input class="form-control" type="text" name="state_bill"/>
                        <label class="form-label">Zipcode: </label>
                        <input class="form-control" type="number" name="zipcode_bill"/>
                        <div class="form-check mt-3">
                            <input class="form-check-input" id="billing_checkbox"  type="checkbox" name="billing_info" value="same_shipping" />
                            <label class="form-check-label" for="billing_checkbox">Same as Shipping</label>
                        </div>
                    </div>

                </div>
                    </form>
                    <a class="btn btn-primary" id="tryPay">Pay</a>
        </section>
    </main>
</body>
</html>