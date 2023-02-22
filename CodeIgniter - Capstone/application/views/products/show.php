<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Product Page) Tshirt | Lashopda</title>
<?php $this->load->view('partials/header') ?>
    <script>

        /*  For pagination highlight    */
        /**********************************************/

        $(document).ready(function(){
            $('.alert').hide();
            

            /*  For submission of forms & updating of cart quantity    */
            $(document).on('submit', 'form', function(){
                var form = $(this);
                $.post(form.attr('action'),form.serialize(), function(){
                    $('.alert').show();
                    setTimeout(function() {
                        $('.alert').fadeOut();
                    }, 1000);
                    $.get('/products/carts/get_cart_count', function(res){
                        console.log(res);
                        $('#cart_items').text(res);
                    });
                });
                return false;
            })
            /**********************************************/
            /**********************************************/

            /*  For changing the big image    */
            var orig = $(".main_img").attr("src");
            $(document).on("mouseenter", ".sub_img", function() {
                $(".sub_img").css("outline", "none");
                var newSrc = $(this).attr("src");
                $(".main_img").fadeOut("fast", function() {
                $(this).attr("src", newSrc).fadeIn("fast");
            });
            $(this).css("outline", "1px solid rgba(8, 0, 167, 0.7)");
                }).on("mouseleave", ".sub_img", function() {
                $(".main_img").fadeOut("fast", function() {
                $(this).attr("src", orig).fadeIn("fast");
            });
            });
            /**********************************************/

            $(document).on("change", "#qty", function() {
                console.log('hello');
                $('#total').text(($('#qty').val()*$('#price').val()).toFixed(2));
            });
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

    <main>
        <section class="item_panel d-flex flex-column">
            <input type="hidden" id="price" name="price" value="<?=$price?>"/>
            <div class="item_details d-flex row">
                    <aside class="img_section col-sm-3">
                        <img class="main_img" src="<?=base_url($main_img)?>" alt="T-shirt"/>        
                        <section>
<?php
foreach($urls as $url){
?>
                            <img class="sub_img" src="<?=base_url($url)?>" alt="T-shirt"/>
<?php
}
?>
                        </section>
                    </aside>
                    <aside class="d-flex flex-column col-sm-9 prod_desc">
                        <h2 id="prod_name"><?=$product_name?></h2>
                        <textarea class="scroll" disabled><?=$description?></textarea>
                        <form action="/products/carts/add_to_cart" method="post">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <input type="hidden" id="product_id" name="product_id" value="<?=$id?>"/>
                            <div class="d-flex row  align-items-end justify-content-end">
                                <div class="col-sm-4 row">
                                    <div class="col-sm-4">
                                        <label for="qty" class="form-label me-2">Qty</label>
                                        <input id="qty" name="qty" class="form-control" type="number" value="1" min="1" max="99">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="total" class="form-label me-3">Total</label>
                                        <p>$<span id="total"><?=$price?></span></p>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <input class="btn btn-lg btn-primary add_to_cart" type="submit" value="Add to Cart">
                                </div>
                            </div>
                        </form>
                    </aside>
            </div>
        </section>
        <article class="similar_items_section d-flex flex-column px-3">
            <h3>Related Items</h3>
            <div class="d-flex justify-content-between">
<?php
foreach($similar as $item)
{
?>
                <section class="products show_products">
                    <figure class="item">
                        <a href="/products/show/<?=$item['id']?>"><img src="<?=base_url($item['img_url'])?>/main.jpg" alt="Tshirt"/></a>
                        <h4 class="mt-2">$<?=$item['price']?></h4>
                    </figure>
                    <p><?=$item['product_name']?></p>
                </section>
<?php
}
?>
            </div>
        </article>
    </main>
    <div class="alert alert-success alert-dismissible fade show fixed-top mt-5 text-center" role="alert">
        Successfully added to cart!
    </div>
</body>
</html>