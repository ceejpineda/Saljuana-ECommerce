<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Dashboard Products)</title>
    <?php $this->load->view('partials/header') ?>
<!-- Dito din nalakagay yung mga modals kung gusto edit -->
    <script src="<?= base_url("/assets/js/products_page.js") ?>"></script>
    
</head>
<body>
<?php $this->load->view('partials/nav-admin') ?>
    <main>
        <p class="message_admin_products"></p>
        <div class="d-flex justify-content-between">
            <form class="form_admin_products_search w-25" action="" method="post">
                <input class="form-control" type="search" name="admin_products_search" placeholder="search">
            </form>
            <button class="btn btn-primary" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal">Add new product</button>
        </div>
        <table class="admin_products_table table table-striped table-hover">
            <thead>
                <tr>
                    <th>Picture</th>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Inventory Count</th>
                    <th>Quantity Sold</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach($products as $product){
?>
                <tr class="color0 product_id_1">
                    <td><img src="<?=base_url($product['img_url'])?>/main.jpg" alt="t-shirt"></td>
                    <td class="product_id"><?=$product['id']?></td>
                    <td><?=$product['product_name']?></td>
                    <td><?=$product['inventory_count']?></td>
                    <td><?=$product['qty_sold']?></td>
                    <td>
                        <a class="btn btn-outline-primary" href="">Edit</a>
                        <a class="btn btn-primary" href="">Delete</a>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
        <!-- <section class="pagination">
                <a href="">1</a><!--
             --><a href="">2</a><!--
             --><a href="">3</a><!--
             --><a href="">4</a><!--
             --><a href="">5</a><!--
             --><a href="">6</a><!--
             --><a href="">7</a><!--
             --><a href="">8</a><!--
             --><a href="">9</a><!--
             --><a href="">10</a><!--
             --><a class="next_page" href="">&rsaquo;</a>
            </section> -->
    </main>
    <div class="admin_product_delete">
        <p>Are you sure you want to delete product "<span class="delete_product_name">Product Name</span>" (ID: <span class="delete_product_id">ID</span>)</p>
        <div>
            <form action="" method="post">
                <input class="product_id" type="hidden" name="product_id" value="id"/>
                <input type="submit" value="Yes" />
            </form>
            <button type="button">No</button>
        </div>
    </div>
    <div class="modal_bg_delete_product"></div>
    <div class="modal_bg"></div>

    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content p-5">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Product</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form class="form_product_add_edit" action="/dashboard/products/process_add" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <input class="product_category_id" type="hidden" name="category_id" value= '0' id="product_category_id" />
                    <label class="form-label">Name:</label>
                    <input class="form-control" type="text" name="product_name" id="product_name">
                    <label class="form-label">Description:</label>
                    <textarea class="form-control" name="product_desc"></textarea>
                    <label class="form-label">Categories:</label>
                    <div class="select_tag_container form-select">
                        <button class="dummy_select_tag" type="button"><span></span><span>&#9660;</span></button>
                        <ul class="product_categories">
                        </ul>
                    </div>
                    <label class="form-label">Add new category:</label>
                    <input class="form-control" type="text" name="product_add_category"/>
                    <label class="form-label">Price:</label>
                    <input class="input_product_price form-control" type="number" name="product_price" min="0.01" step="0.01"/>
                    <label class="form-label">Quantity (Inventory):</label>
                    <input class="input_product_qty form-control" type="number" name="product_qty"/>
                    <label class="img_field_name form-label">Images: </label>
                    <input id="img_upload" type="file" name="product_img_file[]" multiple accept=".png, .jpg, .jpeg" />
                    <label class="file_upload_label btn btn-secondary" for="img_upload">Upload</label>
                    <ul class="img_upload_container">
                    </ul>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-secondary">Preview</button>
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <dialog class="admin_products_add_edit">
        <h3 class="add_edit_product_header">Edit Product - ID 0</h3>
        <button class="btn_close">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                <path fill-rule="evenodd" d="M13.854 2.146a.5.5 0 0 1 0 .708l-11 11a.5.5 0 0 1-.708-.708l11-11a.5.5 0 0 1 .708 0Z"/>
                <path fill-rule="evenodd" d="M2.146 2.146a.5.5 0 0 0 0 .708l11 11a.5.5 0 0 0 .708-.708l-11-11a.5.5 0 0 0-.708 0Z"/>
            </svg>
        </button>

        <div class="bg_category_confirm_delete">
            <div class="category_confirm_delete">
                <p>Are you sure you want to delete "<span class="category_name">Shirt</span>" category?</p>
                <div>
                    <form action="" method="post">
                        <input class="category_id" type="hidden" name="category_id" value="id"/>
                        <input type="submit" value="Yes" />
                    </form>
                    <button type="button">No</button>
                </div>
            </div>
        </div>
    </dialog>
</body>
</html>