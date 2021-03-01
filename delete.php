<?php 
include("scripts.php");
include("connect_db.php");

$id=$_GET['id'];

$dlt=$conn->prepare("DELETE FROM products WHERE products_uniqid=?");
$dlt->execute([$id]);

header("Location:index.php");