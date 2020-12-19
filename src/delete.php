<?php
    include_once "./dbRequests/db.connect.php";
    
    try {
        $cityQuery = "SELECT cityId,city FROM city WHERE city = :city";
        $stmt = $conn->prepare($cityQuery);
        $stmt->bindParam(":city",ucfirst($_GET['city']),PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll();

        if(count($results) === 0){
            header("Location: index.php");
            die();
        }

        $cityId = $results[0]['cityId'];
        $cityTitle = $results[0]['city'];

        $query = "UPDATE weather SET isValid = 0 WHERE weather_id=:weather_id AND cityId=:cityId";
        $deleteStmt = $conn->prepare($query);
        $deleteStmt->bindParam(":weather_id",$_GET['weather_id'],PDO::PARAM_INT);
        $deleteStmt->bindParam(":cityId",$cityId,PDO::PARAM_INT);
        $deleteStmt->execute();
        
        header("Location: detail.php?city=$cityTitle");
    } catch(PDOException $e) {
        echo "PDO Error : Code " . $e->getCode() . " ,Expectation Msg : " . $e->getMessage() . "<br>";
        exit();
    }
?>
