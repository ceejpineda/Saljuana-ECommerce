<div class="d-flex row justify-content-center products_container">
<?php
foreach($products as $product){
?>
                <section class="products col-sm-2 d-flex flex-column justify-content-between align-items-center h-100">
                    <figure class="item d-flex align-items-center">
                        <a href="/products/show/<?=$product['id']?>"><img src="<?=base_url($product['url'])?>" alt="T-shirt"/></a>
                    </figure>
                    <div class="d-flex flex-column info_container align-items-center text-center">
                        <div class="name_container d-flex justify-content-center">
                            <p><?=$product['product_name']?></p>
                        </div>
                        <h5 class="mt-1">$<?=$product['price']?></h5>
                        <div>
                            <span class="fa fa-star <?=($product['rating'] > 0)?'checked-rating':''?>"></span>
                            <span class="fa fa-star <?=($product['rating'] > 1)?'checked-rating':''?>"></span>
                            <span class="fa fa-star <?=($product['rating'] > 2)?'checked-rating':''?>"></span>
                            <span class="fa fa-star <?=($product['rating'] > 3)?'checked-rating':''?>"></span>
                            <span class="fa fa-star <?=($product['rating'] > 4)?'checked-rating':''?>"></span>
                        </div>
                    </div>
                    <form action="/products/carts/add_to_cart" method="post" class="d-flex quick_buy justify-content-center">
                        <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />    
                        <input type="hidden" id="product_id" name="product_id" value="<?=$product['id']?>"/>
                        <input type="hidden" id="qty" name="qty" value="1"/>
                        <input class="btn btn-primary quick_buy_button ms-3" type="submit" value="Buy Now">
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
            <input type="hidden" name="count" value="<?=$count?>" id="count_products">
            </section>