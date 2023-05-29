<?php $keys = array_keys($result[0])?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>(Dashboard Orders)</title>
<?php $this->load->view('partials/header') ?>
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script>
        window.onload = function () {
            var title = $("#sort").val();
            var label = '<?=$keys[0]?>';
            var y = '<?=$keys[1]?>';
            console.log(label,y);
            var dataFromBackEnd =  <?= json_encode($result) ?>;
            var presentedData = [];
            for(let index = 0; index<dataFromBackEnd.length; index++){
                presentedData.push({
                    label: dataFromBackEnd[index][label],
                    y: parseInt(dataFromBackEnd[index][y])
                })
            }
            var options = {
                title: {
                       
                },
                axisY:{
                    labelFontSize: 15
                },
                axisX:{
                    labelFontSize: 12
                },
                data: [              
                    {
                // Change type to "doughnut", "line", "splineArea", etc.
                type: "bar",
                dataPoints: presentedData.reverse()
                    }
                ]
            };
            $("#chartContainer").CanvasJSChart(options);
        }
    </script>
</head>
<body>
<?php $this->load->view('partials/nav-admin') ?>
<main>
    <div class="container bg-light p-5">
        <h1>Seller Analytics</h1>
            <div>
                <form class="d-flex justify-content-center my-4" action="/dashboard/analytics/product_api" method="POST">
                    <select class="form-select w-25" name="sort" id="sort">
                        <option <?=($sort == 0)?'selected':''?> value="0">Most Sold Products</option>
                        <option <?=($sort == 1)?'selected':''?> value="1">Top Rated Products</option>
                        <option <?=($sort == 2)?'selected':''?> value="2">Inventory Count (For restocking)</option>
                        <option <?=($sort == 3)?'selected':''?> value="3">Best Performing Category</option>
                    </select>
                    <input class="btn btn-primary ms-3" type="submit" value="Get Data">
                </form>
            </div>
        <div class="d-flex">
            <table class="table table-striped table-hover">
                <thead>
                    <tr>
<?php 
foreach($keys as $key){
?>
                    <th><?=$key?></th>
<?php
}
?>
                    </tr>
                </thead>
                <tbody>
                    
<?php
foreach($result as $key=>$item){
?>
                <tr>
                    <td><?=$item[$keys[0]]?></td>
                    <td><?=$item[$keys[1]]?></td>
                </tr>
<?php
}
?>
                    
                </tbody>
            </table>
            <div class="ms-5" id="chartContainer" style="height: 480px; width: 100%;"></div>
        </div>
    </div>
</main>
</body>
</html>