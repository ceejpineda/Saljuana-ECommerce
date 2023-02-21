<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Dashboard Orders)</title>
    <?php $this->load->view('partials/header') ?>
    <script>
        /*  For pagination highlight    */
        function pageNumHighlight(pageNum){
            $(".pagination > a").css("background-color", "white").css("color", "blue");
            for(var i = 0; i < document.querySelectorAll(".pagination > a").length; i++){
                if(pageNum == $(".pagination > a:nth-child(" + i + ")").text()){
                    $(".pagination > a:nth-child(" + i + ")").css("background-color", "#1975ff").css("color", "white");
                }
            }
        }
        /**********************************************/

        $(document).ready(function(){

            /*  Submitting of forms will redirect to specified page based on action attribute    */
            $(document).on("submit", "form", function(){
                window.location = $(this).attr("action");
                return false;
            });
            /**********************************************/

            /*  Pagination at footer    */
            var pageNum = 1;
            pageNumHighlight(pageNum);

            $(document).on("click", ".pagination > a:not(.next_page)", function(){
                pageNum = $(this).text();
                pageNumHighlight(pageNum);
                return false;
            });
            $(document).on("click", ".next_page", function(){
                pageNum++;
                pageNumHighlight(pageNum);
                return false;
            });
            /**********************************************/

        });
    </script>
</head>
<body>
<?php $this->load->view('partials/nav-admin') ?>

    <main>
        <p class="message_admin_orders"></p>
        <form class="form_admin_orders" action="" method="post">
            <input type="search" name="admin_orders_search" placeholder="&#x1F50D; search" />
            <select name="admin_orders_status">
                <option value="0">Show All</option>
                <option>Order in process</option>
                <option>Shipped</option>
                <option>Cancelled</option>
            </select>
        </form>
        <table class="admin_orders_table table table-striped table-hover">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Name</th>
                    <th>Date</th>
                    <th>Shipping Address</th>
                    <th>Billing Address</th>
                    <th>Total</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
<?php
foreach($orders as $order){
?>
                <tr>
                    <td><a href="admin_order_detail_page.html"><?=$order['id']?></a></td>
                    <td><?=$order['first_name'] . ' ' . $order['last_name']?></td>
                    <td><?=date_format(date_create($order['created_at']), 'Y-m-d')?></td>
                    <td><?=$order['shipping']?></td>
                    <td><?=$order['billing']?></td>
                    <td>$<?=$order['total_amount']?></td>
                    <td>
                        <form action="" method="post">
                            <input type="hidden" name="product_id" value="product_id"/>
                            <select name="admin_orders_update">
                                <option <?=($order['status']=='pending')?'selected':''?>>Order in process</option>
                                <option <?=($order['status']=='shipped')?'selected':''?>>Shipped</option>
                                <option <?=($order['status']=='cancelled')?'selected':''?>>Cancelled</option>
                            </select>
                        </form>
                    </td>
                </tr>
<?php
}
?>
            </tbody>
        </table>
        <section class="pagination">
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
        </section>
    </main>
</body>
</html>