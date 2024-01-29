<?php

require_once 'Product.php';
require_once 'Category.php';

$dbname = 'draft-shop';
$host = 'localhost';
$dbuser = 'root';
$dbpass = '';

try {
  $db = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $dbuser, $dbpass);
  $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
  echo $e->getMessage();
}


$product = new Product();
$product->setDb($db);
$products = $product->findAll();
var_dump($products);
