<?php
require_once ('autoload.php');

$host = '127.0.0.1';
$dbName = 'test_db';
$user = 'root';
$pass = '';

try {
    $dbh = new PDO("mysql:host=$host;dbname=$dbName;charset=utf8", $user, $pass);





    //@TODO Building


    $storeHandlerBuilding = new \App\Store\StoreModels\StoreHandlerBuilding($dbh);




    $building = $storeHandlerBuilding->findById(2);

    $building ->setNumber(212);
    $storeHandlerBuilding->create($building);


    echo "<pre>";
    var_dump($building);
    echo "</pre>";













    //@TODO Street

//    $storeHandlerStreet = new \App\Store\StoreModels\StoreHandlerStreet($dbh);
//
//
//
//
//    $street = $storeHandlerStreet->colectionDistrictId(1);
//
//
//
//
//    echo "<pre>";
//    var_dump($street);
//    echo "</pre>";


 //@TODO Дистрикт
//    $storeHandlerDistrict = new \App\Store\StoreModels\StoreHandlerDistrict($dbh);
//
//    $district = $storeHandlerDistrict->colectionPopulation(300000);
//    $district = $storeHandlerDistrict->colectionRandDistrict(2);


//    $district->setName('valik');
//    $storeHandlerDistrict->update($district);

    //@TODO Созданее нового
/*    $district = new \App\Model\District();
    $district->setName('Новый Район1');
    $district->setPopulation(123000);


    $storeHandlerDistrict->create($district);*/

//    echo "<pre>";
//    var_dump($district);
//    echo "</pre>";


} catch (PDOException $exception) {
    echo $exception->getMessage();
}

//$dbh = nuul;
