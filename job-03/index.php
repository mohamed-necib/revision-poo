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

$request = $db->prepare("SELECT * FROM product WHERE id = 1");

$request->execute();
$product = $request->fetch(PDO::FETCH_ASSOC);
$product['photos'] = json_decode($product['photos']);
var_dump($product);
