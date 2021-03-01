<?php
$dsn="mysql:host=localhost;dbname=odev5";
$username="root";
$password="";

try{
    $conn= new PDO($dsn,$username,$password,[
        PDO::ATTR_ERRMODE =>PDO::ERRMODE_EXCEPTION,
    ]);
    //echo "basarili";
} catch(PDOExceptin $e){
    echo"bağlanti hatasi\n";
    echo $e->getMessage();

}
