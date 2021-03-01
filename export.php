<?php 
include("connect_db.php");

$export=$conn->query("SELECT *FROM products",PDO::FETCH_ASSOC);
$records = array();
while($exp=$export->fetch()){
    
    $records[]= $exp; 
    
}

echo json_encode($records);

header("Content-Type: application/json;charset=utf-8");
header("Content-Disposition: attachment; filename=products.json");