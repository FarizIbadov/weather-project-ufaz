<?php
    include_once "./dbRequests/db.connect.php";
    session_start();
    $city = ucfirst($_POST['city']);
    try {

        $cityQuery = "SELECT cityId FROM city WHERE city = :city";
        $cityStmt = $conn->prepare($cityQuery);
        $cityStmt->bindParam(":city",$city,PDO::PARAM_STR);
        $cityStmt->execute();

        $result = $cityStmt->fetchAll();

        if(count($result) === 0){
            header("Location: /");
            die();
        }

        $cityId = $result[0]['cityId'];
        $checkQuery = "SELECT * FROM weather WHERE cityId = :cityId AND dates = :dates";

        $checkStmt = $conn->prepare($checkQuery);
        $checkStmt->bindParam(':cityId',$cityId,PDO::PARAM_INT);
        $checkStmt->bindParam(':dates',$_POST['date'],PDO::PARAM_STR);
        $checkStmt->execute();

        if(count($checkStmt->fetchAll()) !== 0){
            $_SESSION['error'] = "Data with this date in this city already exists";
        }else{
            $query = "INSERT INTO 
                        `weather` 
                            ( 
                                `temperature`, 
                                `wind_speed`, 
                                `pressure`, 
                                `humidity`, 
                                `visibility`, 
                                `dates`, 
                                `cityId`, 
                                `overallId`
                            ) 
                    VALUES 
                            (
                                :temperature,
                                :wind_speed,
                                :pressure,
                                :humidity,
                                :visibility,
                                :dates,
                                :cityId,
                                :overallId
                            )";

            $stmt = $conn->prepare($query);
            $stmt->bindParam(':temperature',$_POST['temperature'],PDO::PARAM_INT); 
            $stmt->bindParam(':wind_speed',$_POST['wind-speed'],PDO::PARAM_INT); 
            $stmt->bindParam(':pressure',$_POST['pressure']); 
            $stmt->bindParam(':humidity',$_POST['humidity'],PDO::PARAM_INT); 
            $stmt->bindParam(':visibility',$_POST['visibility']); 
            $stmt->bindParam(':dates',$_POST['date'],PDO::PARAM_STR); 
            $stmt->bindParam(':cityId',$cityId,PDO::PARAM_INT); 
            $stmt->bindParam(':overallId',$_POST['overallId'],PDO::PARAM_INT); 
            $stmt->execute();
        }
        header("Location: detail.php?city=$city");
        die();
    } catch(PDOException $e) {
        echo "PDO Error : Code " . $e->getCode() . " ,Expectation Msg : " . $e->getMessage() . "<br>";
        exit();
    }

?>
