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