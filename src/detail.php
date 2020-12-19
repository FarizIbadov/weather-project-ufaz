<?php 
    include_once "./dbRequests/fetchItem.php"; 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <link rel="stylesheet" href="./assets/style.css">
    <title>Weather in <?php echo $_GET['city'] ?></title>
</head>
<body class="bg-light">
     <?php include_once "./components/form.modal.php"?>
     <?php include_once "./components/nav.php" ?>
     <main class="container">
        <?php 
            if($_SESSION['error']){
                echo "<div class='alert alert-danger alert-dismissible fade show mt-5'>"
                        .$_SESSION['error'].
                     "
                        <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                            <span aria-hidden='true'>&times;</span>
                        </button>
                     </div>";
                    session_unset();
            }
                    
        ?>
         <h1 class="text-center my-4"><?php echo $_GET['city'] ?></h1>
         <div class="row">
             <div class="city-chart-container" id="tempChart"></div>
             <div class="col-lg-6 ">
                <h3 class="text-center mb-3"><?php echo date('l'); ?> (Today)</h3>
                <table class="table table-sm">
                    <tbody>
                        <tr>
                            <td><h5>Temperature:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->temperature ?>℃</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>Pressure:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->pressure ?> mmHg</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>Overall:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->overall ?></h5>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>Wind Speed:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->wind_speed ?> km/h</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>Humidity:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->humidity ?>%</h5>
                            </td>
                        </tr>
                        <tr>
                            <td><h5>Visibility:</h5></td>
                            <td>
                                <h5><?php echo $singleWeather->visibility ?> km/h</h5>
                            </td>
                        </tr>
                    </tbody>
                </table>
             </div>
         </div>
         <table class="table table-sm mt-5" >
            <thead>
                <tr>
                    <th scope="col">Date</th>
                    <th scope="col">Temperature</th>
                    <th scope="col">Overall</th>
                    <th scope="col" class='hidden'>Wind speed</th>
                    <th scope="col" class='hidden'>Pressure</th>
                    <th scope="col" class='hidden'>Humidity</th>
                    <th scope="col"  class='hidden'>Visibility</th>
                    <th scope="col"></th>
                    <th scope="col"></th>
                </tr>
            </thead>
            
            <tbody id="weather-body">
                <?php
                    foreach($weatherList as $key => $val){
                        echo "
                            <tr class='weather-row'>
                                <td data-date='$val->date'>".date("l",strtotime($val->date))."</td>
                                <td data-temp='$val->temperature'>".$val->temperature."℃</td>
                                <td data-overall='$val->overallId'>".$val->overall."</td>
                                <td data-wind='$val->wind_speed' class='hidden'>".$val->wind_speed." km/h</td>
                                <td data-pressure='$val->pressure' class='hidden'>".$val->pressure." mmHg</td>
                                <td data-humid='$val->humidity' class='hidden'>".$val->humidity."%</td>
                                <td data-visibility='$val->visibility' class='hidden'>".$val->visibility." km</td>
                                <td>
                                    <a href='delete.php?city=".$_GET['city']."&weather_id=$key' class='list-btn btn btn-outline-danger btn-sm d-flex h-100 align-items-center justify-content-center'>
                                        <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-x' viewBox='0 0 16 16'>
                                        <path fill-rule='evenodd' d='M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z'/>
                                        </svg>
                                    </a>
                                </td>
                                <td>
                                    <button 
                                        data-id='$key'
                                        data-toggle='modal' data-target='#modalForm' class='edit-btn btn btn-default d-flex h-100 align-items-center'>
                                            <svg xmlns='http://www.w3.org/2000/svg' width='16' height='16' fill='currentColor' class='bi bi-pencil-fill text-primary' viewBox='0 0 16 16'>
                                            <path fill-rule='evenodd' d='M12.854.146a.5.5 0 0 0-.707 0L10.5 1.793 14.207 5.5l1.647-1.646a.5.5 0 0 0 0-.708l-3-3zm.646 6.061L9.793 2.5 3.293 9H3.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.207l6.5-6.5zm-7.468 7.468A.5.5 0 0 1 6 13.5V13h-.5a.5.5 0 0 1-.5-.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.5-.5V10h-.5a.499.499 0 0 1-.175-.032l-.179.178a.5.5 0 0 0-.11.168l-2 5a.5.5 0 0 0 .65.65l5-2a.5.5 0 0 0 .168-.11l.178-.178z'/>
                                            </svg>
                                     </button>
                                </td>
                            </tr>
                        ";
                    }
                ?>
            </tbody>
        </table>
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center" id="paginator">
                <li class="page-item" data-arrow="1" data-x="-1">
                    <a class="page-link d-flex h-100 align-items-center"  >
                        <?php include "./components/icon.left.php" ?>
                    </a>
                </li>
<!-- 
                <li class="page-item"><a class="page-link" >1</a></li>
                <li class="page-item"><a class="page-link" >2</a></li>
                <li class="page-item"><a class="page-link" >3</a></li> -->

                <li class="page-item"  data-arrow="1" data-x="1">
                    <a class="page-link d-flex h-100 align-items-center" >
                        <?php include "./components/icon.right.php" ?>
                    </a>
                </li>
            </ul>
        </nav>
        <div class="row justify-content-center my-3">
            <div class="col-md-3 my-1">
                <a href="/index.php" class="btn btn-block btn-outline-dark d-flex justify-content-center align-items-center">
                    <?php include "./components/icon.left.php" ?>  
                    <span class="ml-2">Back</span>
                </a>
            </div>
            <div class="col-md-3 my-1">
                <button id="addBtn" data-toggle="modal" data-target="#modalForm" class="btn btn-block btn-dark">Add Data</button>
            </div>
        </div>
     </main>
    
    <script src="./assets/app.js"></script>
</body>
</html>