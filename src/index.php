<?php include_once "./dbRequests/fetchList.php" ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/style.css">
    <title>Weather App</title>
</head>
<body class="bg-light">
    <?php include_once "./components/nav.php" ?>
    <main class="container">
        <h1 class="text-center my-4">Cities</h1>
        <ul class="list-group list-group-flush mt-5">
            
                <?php 
                    foreach($temperatureList as $key => $value){
                        echo '
                            <li class="list-group-item">
                                <div class="row justify-content-between align-items-center">
                                    <h4 class="col-sm-2 text-center my-1">'.$value->city.'</h4>
                                    <h4 class="col-sm-2 mr-auto mb-0">'.$value->temperature.'</h4>
                                    <div class="col-md-2 my-1">
                                        <a href="/detail.php?city='.$value->city.'" class="btn btn-block  btn-dark btn-sm mr-2">Detail</a>
                                    </div>
                                </div>
                            </li>
                        ';
                    }
                ?>
            
        </ul>
        
    </main> 
    <script src="./assets/app.js"></script>
</body>
</html>
