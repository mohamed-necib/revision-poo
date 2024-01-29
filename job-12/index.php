<?php

require_once 'Product.php';
require_once 'Category.php';
require_once 'Clothing.php';
require_once 'Electronic.php';



// FINDONEBYID

$clothing = new Clothing();
$newClothing = $clothing->findOneById(2);

var_dump($newClothing);

$electronic = new Electronic();

$newElectronic = $electronic->findOneById(1);

var_dump($newElectronic);

//FINDALL

$clothing = new Clothing();
$electronic = new Electronic();

$newClothing = $clothing->findAll();
$newElectronic = $electronic->findAll();

var_dump($newElectronic);
var_dump($newClothing);



//CREATE

$clothing = new Clothing(
    null,
    "T-shirt",
    ["t-shirt.jpg"],
    10,
    "A nice t-shirt",
    10,
    new DateTime(),
    new DateTime(),
    1,
    "M",
    "red",
    "t-shirt",
    1
);

$clothing->create();

var_dump($clothing);

$electronic = new Electronic(
    null,
    "TV",
    ["tv.jpg"],
    100,
    "A nice TV",
    10,
    new DateTime(),
    new DateTime(),
    1,
    "Samsung",
    10,
    1
);

$electronic->create();

var_dump($electronic);


//UPDATE

$clothing = new Clothing();
$clothing = $clothing->findOneById(18);

$clothing->setColor("black");


$result = $clothing->update();

var_dump($result);

$electronic = new Electronic();
$electronic = $electronic->findOneById(1);

$electronic->setBrand("Samsung");

$result = $electronic->update();

var_dump($result);
