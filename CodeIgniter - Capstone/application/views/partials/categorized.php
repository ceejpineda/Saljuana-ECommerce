<?php
foreach($products as $product){
?>
                <section class="products">
                    <figure class="item">
                        <a href="/products/show/<?=$product['id']?>"><img src="<?=base_url($product['url'])?>" alt="T-shirt"/></a>
                        <h4><?=$product['price']?></h4>
                    </figure>
                    <p><?=$product['product_name']?></p>
                </section>
<?php
}
?>