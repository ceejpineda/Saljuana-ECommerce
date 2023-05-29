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
                        <form action="/dashboard/products/delete/<?=$product['id']?>" method="post" class="form_delete_product">
                            <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                            <a class="btn btn-outline-primary edit_modal_button" data-bs-toggle="modal" data-bs-target="#edit_modal" href="/dashboard/products/edit_data/<?=$product['id']?>">Edit</a>
                            <input type="submit" class="btn btn-primary delete_product" value="Delete">
                        </form>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
        <section class="pagination d-flex justify-content-center">
<?php for($page = 1; $page<=$pages; $page++)
{
?>
            <input type="submit" value="<?=$page?>" class="submit_search btn btn-secondary mx-2">
<?php 
}
?>
        </section>