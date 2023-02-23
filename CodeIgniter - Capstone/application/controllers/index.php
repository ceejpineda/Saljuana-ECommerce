<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <script src="https://canvasjs.com/assets/script/jquery-1.11.1.min.js"></script>
    <script src="https://canvasjs.com/assets/script/jquery.canvasjs.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="<?= base_url("/assets/style.css")?>">
    <script>
        window.onload = function () {
            
            var dataFromBackEnd =  <?= json_encode($table) ?>;
            var presentedData = [];
            for(let index = 0; index<dataFromBackEnd.length; index++){
                presentedData.push({
                    label: dataFromBackEnd[index]['Month'],
                    y: parseInt(dataFromBackEnd[index]['Total Cost'])
                })
            }
            for(let row=0; row<(<?= count($table) ?>); row++){
            }


            var options = {
                title: {
                text: "Client Billing"              
                },
                data: [              
                    {
                // Change type to "doughnut", "line", "splineArea", etc.
                type: "column",
                dataPoints: presentedData
                    }
                ]
            };
            $("#chartContainer").CanvasJSChart(options); 
            }
    </script>
    <title>Client Billing</title>
</head>
    <body>
        <div class="container main">
            <h1>CLIENT BILLING</h1>
            <div class="container col-sm-5">
                <form action="/Billings/submit" method="POST" class="d-flex align-items-center">
                    <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                    <label for="from" class="form-label">From:</label>
                    <input type="date" name="from" id="from" class="form-control mx-3" value="2011-01-01">
                    <label for="to" class="form-label">To:</label>
                    <input type="date" name="to" id="to" class="form-control mx-3" value="2011-12-31">
                    <input class="btn btn-success" type="submit" value="Get Data">
                </form>
            </div>
            <div class="row">
                <div class="container col-sm-6">
                <p class='title'>Data for total charges per month</p>
                <table class="table table-striped table-secondary">
                        <thead>
                            <tr>
                                <th scope="col">Month</th>
                                <th scope="col">Year</th>
                                <th scope="col">Total Cost</th>
                            </tr>
                        </thead>
                        <tbody>
<?php
for($row=0; $row<count($table); $row++){
?>
                            <tr>
<?php
foreach($table[$row] as $col){
?>
                                <td><?= $col ?></td>
<?php
}
?>
                            </tr>
<?php
}
?>
                        </tbody>
                    </table>
                </div>
                <div class="container col-sm-6 d-flex align-items-center">
                    <div id="chartContainer" style="height: 370px; width: 100%;"></div>
                </div>
            </div>
        </div>
    </body>
</html>