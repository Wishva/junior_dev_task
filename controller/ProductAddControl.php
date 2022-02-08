<?php

use devTask\productBook;
use devTask\ProductDisk;
use devTask\ProductFurniture;

include_once '../vendor/autoload.php';

$ProductBook = new ProductBook();
$ProductDisk  = new ProductDisk();
$ProductFurniture = new ProductFurniture();


//below methods will output the values in order to user selection

if (isset($_POST['checkType']) && isset($_POST['productType']) && !empty($_POST['productType'])) {
    $typeObject = $_POST['productType'];
    $$typeObject->viewProductFields();
}

//below code will facilitate the form validations and submission according to the product type

if (isset($_POST['checkMainFields']) && isset($_POST['proType'])) {
    $typeObject = $_POST['proType'];
    $$typeObject->validateFields();
}
