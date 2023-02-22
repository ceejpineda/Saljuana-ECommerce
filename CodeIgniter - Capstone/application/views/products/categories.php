<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Saljuana | Products</title>
<?php $this->load->view('partials/header') ?>
    <script src="<?= base_url('assets/js/categories.js') ?>"></script>
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
    <main class="d-flex justify-content-between">
    <div class="row w-100">
        <aside class="category_panel col-sm-2">
            <form action="/products/categories/filter" method="post" id="search">
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                <input class="form-control" type="search" name="product_name" placeholder="Product name" />
                <input type="hidden" name="page" value="1" id="page">
            </form>
            <section class="products_categories">
                <h4>Categories</h4>
<?php
foreach($categories as $category){
?>
            <div class="d-flex category_item align-items-center">
                <!-- <input type="hidden" name="category_list" id="category_list" value="<?=$names?>"> -->
                <input class="form-check-input" type="checkbox" name="categories[]" form="search" value="<?=$category['id']?>">
                <label for="search_checkbox"><span class="category_items"><?=$category['category_name']?></span> (<?=$category['count']?>)</label>
            </div>

<?php
}
?>
                <a class="show_all_products" href="">All Products</a>
            </section>
        </aside>
        <article class="catalog col-sm-10">
            <div class="subheader d-flex align-items-center justify-content-between">
                <h2><span class="category_name"><span id="product_count">All</span> Items</h2>
                <div>
                    <label class="mb-0 mt-1">Sorted by </label>
                    <select class="form-select mb-1" name="sort_by" form="search">
                        <option value="0">Price: Low to High</option>
                        <option value="1">Price: High to Low</option>
                        <option value="2">Most Popular</option>
                        <option value="3">Top Rated</option>
                    </select>
                </div>
            </div>
            <div id="paginated">
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
    <div class="alert alert-success alert-dismissible fade show fixed-top mt-5" role="alert">
        Successfully added to cart!
    </div>
            </section>
            </div>
        </article>
    </div>
    </main>
</body>
</html>