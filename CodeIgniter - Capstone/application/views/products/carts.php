<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Carts Page) Shopping Cart | Lashopda</title>
<?php $this->load->view('partials/header') ?>
    <script>
        $(document).ready(function(){
            
        });
    </script>
</head>
<body>
    <nav class="navbar navbar-expand-lg fixed-top" id="nav" data-bs-theme="dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Saljuana</a>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            </div>
            <div>
                <a href="/products/carts" class="btn logoff" type="submit">Shopping Cart (<span id="cart_items"><?=$count?></span>)</a>
                <a href="/users/logout" class="btn logoff" type="submit">Log-Off</a>
            </div>
        </div>
    </nav>
    <main class="row d-flex flex-row">
        <section class="cart_table_section col-sm-6">
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
                            <form action="">
                                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                                <input class="form-control qty_cart text-start" type="number" name="qty" id="qty" value="<?=$item['qty']?>">
                            </form>
                            <a type="submit" class="btn btn-danger cart_delete">Delete</a>
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
        </section>
        <section class="cart_billing_section col-sm-6 p-4">
            <form class="d-flex flex-column" action="/products/carts/finalize_order" method="post">
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
                            <input class="form-check-input"  type="checkbox" name="billing_info" value="same_shipping" />
                            <label class="form-check-label" for="billing_checkbox">Same as Shipping</label>
                        </div>
                    </div>

                </div>
                    <div>
                        <h2>Card Information</h2>
                        <div class="input-group">
                            <input class="form-control" type="number" name="card_number" placeholder="Card Number"/>
                            <input class="form-control" type="number" name="card_security" placeholder="Security Number"/></span>
                        </div>
                        <label class="form-label">Expiration: </label>
                        <div class="d-flex justify-content-between">
                            <div class="input-group w-50">
                                    <input class="form-control" type="number" name="card_exp_month" placeholder="(mm)"/>
                                    <input class="form-control" type="number" name="card_exp_year" placeholder="(year)"/>
                                </div>
                            <input class="btn btn-primary" type="submit" value="Pay"/>
                        </div>
                    </div>
                </div>
            </form>
        </section>
    </main>
</body>
</html>