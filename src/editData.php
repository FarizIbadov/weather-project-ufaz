<?php
    include_once "./dbRequests/db.connect.php";
    session_start();
    $city = ucfirst($_POST['city']);

    try{
        $checkQuery = "SELECT * FROM weather WHERE dates = :dates";
        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(":dates",$_POST['date'],PDO::PARAM_STR);
        $checkStmt->execute();

        $result = $checkStmt->fetchAll(); 

        if(count($result) !== 0 and $result[0]['weather_id'] !== $_POST
        ['weather_id']){
            print_r($result);
            $_SESSION['error'] = "Data with this date in this city already exists";
        }else{
            $query = "UPDATE `weather` 
                        SET 
                            `temperature`= :temperature,
                            `wind_speed`= :wind_speed,
                            `pressure`= :pressure,
                            `humidity`= :humidity,
                            `visibility`= :visibility,
                            `dates`= :dates,
                            `overallId`= :overallId 
                        WHERE 
                            weather_id = :weather_id  
                        ";
    
            $stmt = $conn->prepare($query);
            $stmt->bindParam(':temperature',$_POST['temperature'],PDO::PARAM_INT); 
            $stmt->bindParam(':wind_speed',$_POST['wind-speed'],PDO::PARAM_INT); 
            $stmt->bindParam(':pressure',$_POST['pressure']); 
            $stmt->bindParam(':humidity',$_POST['humidity'],PDO::PARAM_INT); 
            $stmt->bindParam(':visibility',$_POST['visibility']); 
            $stmt->bindParam(':dates',$_POST['date'],PDO::PARAM_STR); 
            $stmt->bindParam(':overallId',$_POST['overallId'],PDO::PARAM_INT); 
            $stmt->bindParam(":weather_id",$_POST['weather_id'],PDO::PARAM_INT);
            $stmt->execute();
        }
   
        header("Location: detail.php?city=$city");
        die();
    } catch(PDOException $e) {
        echo "PDO Error : Code " . $e->getCode() . " ,Expectation Msg : " . $e->getMessage() . "<br>";
        exit();
    }
?>