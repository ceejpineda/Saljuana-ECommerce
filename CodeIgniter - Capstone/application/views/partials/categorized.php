<?php
foreach($products as $product){
?>
                <section class="products col-sm-2 d-flex flex-column justify-content-between align-items-center">
                    <figure class="item">
                        <a href="/products/show/<?=$product['id']?>"><img src="<?=base_url($product['url'])?>" alt="T-shirt"/></a>
                    </figure>
                    <div class="d-flex flex-column info_container">
                        <div class="name_container d-flex flex-column justify-content-between">
                            <p><?=$product['product_name']?></p>
                        </div>
                        <h3><?=$product['price']?></h3>
                        <div class="d-flex">
                            <form action="" method="post">
                                <input class="btn btn-primary" type="submit" value="buy">
                            </form>
                        </div>
                    </div>
                </section>
<?php
}
?>