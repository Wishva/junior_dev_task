<?php

use devTask\ProductFunctions;

include_once '../vendor/autoload.php';

$productObj = new ProductFunctions();

$productObj->productMassDelete();
