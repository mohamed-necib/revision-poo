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


$product = new Product(null, 'Tanga', ['https://images.unsplash.com/photo-1651671685354-8ef9110ea28e?w=1400&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8dGFuZ2F8ZW58MHx8MHx8fDA%3D'], 10, 'Un tanga', 10, new DateTime(), new DateTime(), 1);
$product->setDb($db);

$product->create();
var_dump($product);
