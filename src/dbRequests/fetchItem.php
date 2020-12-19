<?php
    include_once "db.connect.php";
    session_start();
    if(!array_key_exists("city",$_GET)){
        header("Location: /");
        die();
    }
    $city = ucfirst($_GET['city']);
    
    $query = "SELECT * FROM city WHERE city = :city";
    $stmt = $conn->prepare($query);
    
    $stmt->bindParam(':city',$city,PDO::PARAM_STR);
    $stmt->execute();
    
    if (count($stmt->fetchAll()) === 0){
        header("Location: /");
        die();
    }

    $listQuery = "SELECT * FROM weather JOIN city USING (cityId) JOIN overall USING (overallId) WHERE city.city = :city AND weather.isValid=1 ORDER BY weather.dates";
    $listStmt = $conn->prepare($listQuery);
    $listStmt->bindParam(":city",$city,PDO::PARAM_STR);
    $listStmt->execute();

    
    $weatherList = array(); 
    
    foreach ($listStmt->fetchAll() as $var){
        $weather = new WeatherItem($var);
        $weatherList[$var['weather_id']] = $weather;
    }

    $overallQuery = "SELECT overallId,overall FROM overall WHERE isValid=1";
    $overallStmt = $conn->prepare($overallQuery);
    $overallStmt->execute();

    $overallList = array(); 

    foreach($overallStmt->fetchAll() as $var){
        $overallList[$var['overallId']] = $var['overall'];
    }

    $today = date('Y-m-d');

    $singleWeatherQuery = "SELECT * FROM weather JOIN overall USING (overallId) JOIN city USING (cityId) WHERE weather.dates = :dates AND city.city = :city";

    $singleStmt = $conn->prepare($singleWeatherQuery);
    $singleStmt->bindParam(":dates",$today,PDO::PARAM_STR);
    $singleStmt->bindParam(":city",$city,PDO::PARAM_STR);
    $singleStmt->execute();



    $singleWeather = new WeatherItem($singleStmt->fetchAll()[0]);
    
    

    class WeatherItem{
        public $temperature;
        public $wind_speed;
        public $pressure;
        public $humidity;
        public $visibility;
        public $date;
        public $overall;
        public $overallId;

        public function __construct($row)
        {   
            $this->temperature = $row['temperature'];
            $this->wind_speed = $row['wind_speed'];
            $this->pressure = $row['pressure'];
            $this->humidity = $row['humidity'];
            $this->visibility = $row['visibility'];
            $this->date = $row['dates'];
            $this->overall = $row['overall'];
            $this->overallId = $row['overallId'];
        }
    }
    
?>

