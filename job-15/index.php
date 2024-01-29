<?php

require_once 'Product.php';
require_once 'Category.php';
require_once 'Clothing.php';
require_once 'Electronic.php';


$clothing = new Clothing();
$newClothing = $clothing->findOneById(18);
var_dump($newClothing);
$newClothing->addStocks(15);

var_dump($newClothing);


 






