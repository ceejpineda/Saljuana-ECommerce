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
<?php $this->load->view('partials/nav-user') ?>
    <main class="d-flex justify-content-between outline">
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
        <article class="catalog col-sm-10 outline">
            <div class="subheader">
                <h2><span class="category_name"><span id="product_count">All</span> Items</h2>
                <section class="pagination_top">
                    <a class="first_page" href="">first</a><!--
                ---><a class="prev_page" href="">prev</a><!--
                ---><p><span class="page_number">1</span></p><!--
                ---><a class="next_page" href="">next</a>
                </section>
            </div>
            <form action="" method="post">
                <label>Sorted by </label>
                <select name="sort_by">
                    <option value="0">Price: Low to High</option>
                    <option value="1">Price: High to Low</option>
                    <option value="2">Most Popular</option>
                </select>
            </form>
            <div id="paginated">
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
            </div>
        </article>
    </div>
    </main>
</body>
</html>