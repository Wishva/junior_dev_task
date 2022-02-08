<?php

use devTask\ProductFunctions;
use devTask\ProductBook;
use devTask\ProductFurniture;
use devTask\ProductDisk;

include_once('header.php');
include_once('../vendor/autoload.php');

$productObj = new ProductFunctions();
$ProductBook = new ProductBook();
$ProductDisk  = new ProductDisk();
$ProductFurniture = new ProductFurniture();

?>


<body>

    <div class="page-wrap">
        <!-- Page Content-->
        <div class="container">

            <!-- Header of the page-->
            <div class="mt-3 mb- 5 pt-3 pb-2">
                <div class="row">
                    <div class="col-md-10 " style="padding-top: 3px; border-bottom: 2px solid black">
                        <p class="text-black ml-3 mt-5" id="proList"><b>Product List</b></p>
                    </div>
                    <div class="col-md-2  " style="padding-top: 1%; border-bottom: 2px solid black">

                            <button type="button" class="btn-primary mt-5 mr-2  addBtn" id="addBtn">ADD</button>
                        <button type="button" class="btn-danger  mt-5 ml-1 mDeleteBtn" id="mDeleteBtn"
                                name="mDeleteBtn">
                            MASS DELETE</button>

                    </div>


                </div>


            </div>

            <!-- Contents-->
            <div class="row mt-5">

                <?php
                $productData = $productObj->getProductData();
                while ($row = $productData->fetch_row()) {
                    $productObj->setProductData($row);
                    $obj = $productObj->productType;

                    //view product according to the child class function
                    $$obj->viewProduct(
                        $productObj->productSku,
                        $productObj->productName,
                        $productObj->productPrice,
                        $productObj->productAttribute
                    );
                }


                ?>

            </div>

        </div>

    </div>

<?php
include_once('footer.php');











