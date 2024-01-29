<?php

require_once 'Product.php';

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

$request = $db->prepare("SELECT * FROM product WHERE id = 7");

$request->execute();

$result = $request->fetch(PDO::FETCH_ASSOC);
$result['photos'] = json_decode($result['photos']);


// hydratation de l'instance product
$product = new Product(
    $result['id'],
    $result['name'],
    $result['photos'],
    $result['price'],
    $result['description'],
    $result['quantity'],
    new DateTime($result['createdAt']),
    new DateTime($result['updatedAt']),
    $result['category_id']
);

var_dump($product);






