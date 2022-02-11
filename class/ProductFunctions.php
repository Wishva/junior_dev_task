<?php

namespace devTask;

use Exception;
use mysqli;

class ProductFunctions extends ProductLogic
{
    use ProductValidation; // use the ProductValidation trait

    //some of the product properties are public because to call as object properties in index page

    protected $dbCon;
    public $productSku;
    public $productName;
    public $productPrice;
    public $productType;
    public $productAttribute;
    public $productSize;
    public $productWeight;
    public $productHeight;
    public $productWidth;
    public $productLength;


    //start the database connection
    public function __construct()
    {
        try {
            $this->dbCon = new mysqli("localhost", "root", "", "dev_project");
        } catch (Exception $e) {
            echo "Connection Failed" . $e->getMessage();
        }
    }

    protected function viewProduct($sku, $name, $price, $attr)
    {
       //this method will override by the child classes
        return null;
    }

    //function to get product data from the database
    public function getProductData()
    {
        $sqlQuery = "SELECT * FROM tbl_product ORDER BY sku";
        $executeQuery = $this->dbCon->query($sqlQuery);
        $numRows = $executeQuery->num_rows;
        if ($numRows) {
            return $executeQuery;
        } else {
            return false;
        }
    }

    //function to set the values to the properties
    public function setProductData($productRow)
    {
        //get the array into a variable
//        $proData = $this->getProductData();
//        while ($row = $proData->fetch_row()) {
//            print_r($row);
//        }

        $this->productSku = $productRow[0];
        $this->productName = $productRow[1];
        $this->productPrice = $productRow[2];
        $this->productType = $productRow[3];
        $this->productAttribute  = $productRow[4];
    }

    //function for product deletion
    public function deleteProduct()
    {
        $sqlQuery = "DELETE FROM `tbl_product` WHERE sku = '" . $this->productSku . "' ";
        $this->dbCon->query($sqlQuery);
        $numRows = $this->dbCon->affected_rows;
        if ($numRows) {
            return true;
        } else {
            return false;
        }
    }

    //function for mass delete products
    public function productMassDelete()
    {
        if (isset($_POST['checkDeleteBtn']) && isset($_POST['checkedProducts'])) {
            $checkedProducts = $_POST['checkedProducts'];
            foreach ($checkedProducts as $proSku) {
                $this->productSku = $proSku;
                $this->deleteProduct();
            }
        }
        echo true;
    }

    //this method will overwrite by the child methods
    protected function viewProductFields()
    {
        return null;
    }

    //this function will check the existence of the sku in DB
    public function checkSkuExistence()
    {
        $sqlQuery = "SELECT * FROM tbl_product WHERE sku='" . $this->productSku . "'";
        $executeQuery = $this->dbCon->query($sqlQuery);
        $numRows = $executeQuery->num_rows;
        if ($numRows) {
            return true;
        } else {
            return false;
        }
    }

    //this function will validate the common fields to all 3 product types
    protected function validateFields()
    {
        $checkFlag = 1;
        if (
            isset($_POST['checkMainFields']) && isset($_POST['proSku']) && isset($_POST['proName'])
            && isset($_POST['proPrice']) && isset($_POST['proType'])
        ) {
            $this->productSku = $this->dbCon->real_escape_string($_POST['proSku']);
            $this->productName = $this->dbCon->real_escape_string($_POST['proName']);
            $this->productPrice = $this->dbCon->real_escape_string($_POST['proPrice']);
            $this->productType = $this->dbCon->real_escape_string($_POST['proType']);

            //check for empty fields
            //sku field
            if (!$this->checkEmptyInputs($this->productSku)) {
                echo 'emptySku';
                $checkFlag = 0;
            }
            //name field
            if (!$this->checkEmptyInputs($this->productName)) {
                echo 'emptyName';
                $checkFlag = 0;
            }
            //price field
            if (!$this->checkEmptyInputs($this->productPrice)) {
                echo 'emptyPrice';
                $checkFlag = 0;
            }

            //check for price field to correct data type
            if (!$this->checkNumberInputs($this->productPrice)) {
                echo 'wrongPrice';
                $checkFlag = 0;
            }

            //check for product sku existence in the DB
            if ($this->checkSkuExistence()) {
                echo 'skuExists';
                $checkFlag = 0;
            }
        } else {
            $checkFlag = 0;
        }
        return $checkFlag;
    }

    //function for add product
    protected function addProduct()
    {
        $sqlQuery = "INSERT INTO tbl_product(`sku`, `name`, `price`, `type`, `attribute`)
        VALUES ('" . $this->productSku . "', '" . $this->productName . "',
         '" . $this->productPrice . "', '" . $this->productType . "', '" . $this->productAttribute . "')";
        $executeQuery = $this->dbCon->query($sqlQuery);
        if ($executeQuery) {
            return true;
        } else {
            return false;
        }
    }


    //close the database connection
    public function __destruct()
    {
        $this->dbCon->close();
    }
}
