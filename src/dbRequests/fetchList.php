<?php
    include_once "db.connect.php";
    
    $query = "SELECT cityId,city FROM city WHERE isValid=1";

    $result = $conn->query($query);
    $result->setFetchMode(PDO::FETCH_ASSOC);
    $temperatureList = array();

    foreach($result->fetchAll() as $var){
        $temperatureListItem = new CityListItem($var['city']);
        $temperatureList[$var['cityId']] = $temperatureListItem;
    }

    class CityListItem {
        public $city;
        public function __construct($city){
            $this->city = $city;  
        }
    }
?>