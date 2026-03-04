<?php

$host = "localhost";
$dbname = "car_rental_db";
$username = "root";
$password = "";

try {
    $pdo = new car_rental_db("mysql:host=$host;dbname=$dbname",
     $username, $password);
    $pdo->setAttribute(car_rental_db::ATTR_ERRMODE, car_rental_db::ERRMODE_EXCEPTION);

} catch(car_rental_dbException $e) {
    die("Connection failed: " . $e->getMessage());
}
?>