<?php

$dsn = "mysql:host=localhost;dbname=phpcrud";
$user = "root";
$pass = "";
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

try{
    $con = new PDO($dsn, $user, $pass, $options); 
    //echo "Connecting";   
} catch(PDOException $e){
    echo "Failed To Connect " . $e->getMessage();
}