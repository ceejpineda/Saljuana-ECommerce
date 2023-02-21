<div class="d-flex row justify-content-center products_container">
<?php
foreach($products as $product){
?>
                <section class="products col-sm-2 d-flex flex-column justify-content-between align-items-center h-100">
                    <figure class="item d-flex align-items-center">
                        <a href="/products/show/<?=$product['id']?>"><img src="<?=base_url($product['url'])?>" alt="T-shirt"/></a>
                    </figure>
                    <div class="d-flex flex-column info_container">
                        <div class="name_container d-flex flex-column align-items-center justify-content-between">
                            <p><?=$product['product_name']?></p>
                        </div>
                        <h3><?=$product['price']?></h3>
                    </div>
                    <form action="" method="post" class="d-flex quick_buy">
                        <input class="btn btn-primary h-100" type="submit" value="Buy Now">
                    </form>
                </section>
<?php
}
?>
            </div>
            <section class="pagination">
            <?php for($page = 1; $page<=$pages; $page++)
{
?>
                <input type="submit" value="<?=$page?>" class="submit_search btn btn-secondary mx-2">
<?php 
}
?>
            </section>