<?php

//Autoload
require_once 'vendor/autoload.php';

//Classes

use App\Product;
use App\Clothing;
use App\Electronic;
use App\Category;



$clothing = new Clothing();
$newClothing = $clothing->findOneById(18);
var_dump($newClothing);
$newClothing->addStocks(15);

var_dump($newClothing);


 






