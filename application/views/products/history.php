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
        <section class="cart_table_section">
            <table class="table table-striped text-start">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Total Amount</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
<?php
foreach($orders as $order){
?>
                    <tr>
                        <td><?=$order['first_name'] . ' ' . $order['last_name']?></td>
                        <td><?=$order['shipping']?></td>
                        <td>$<?=$order['total_amount']?></td>
                        <td><?=$order['status']?></td>
                        <td><?=$order['created_at']?></td>
                    </tr>
<?php
}
?>
                </tbody>
            </table>   
        </section>
    </main>
</body>
</html>