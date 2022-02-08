<?php

namespace devTask;

//use devTask\ProductFunctions;
//
//require_once 'ProductFunctions.php';

class ProductFurniture extends ProductFunctions
{
    //override the view product function to furniture
    public function viewProduct($sku, $name, $price, $attr)
    {
        echo '<div class="col-lg-3 col-md-3 col-xs-6 mb-5 ">
                    <div class="card viewBox">
                        <div class="card-body">
                            <h5 class="card-title"><input type="checkbox" class="delete-checkbox" 
                            value=' . $sku . '></h5>
                            <p class="card-text text-center">' . $sku . '
                             <BR>' . $name . '
                            <BR>' . $price . ' $
                            <BR>Dimension: ' . $attr . '</p>
                            <br>
                        </div>
                    </div>
                </div>';
    }

    //override the function to view special fields
    public function viewProductFields()
    {
        echo "productFurnitureForm";
    }

    //override the validation function
    public function validateFields()
    {
        $checkFlag = true;
        $checkFlagParent = parent::validateFields();

            $this->productWidth = $this->dbCon->real_escape_string($_POST['proWidth']);
            $this->productHeight = $this->dbCon->real_escape_string($_POST['proHeight']);
            $this->productLength = $this->dbCon->real_escape_string($_POST['proLength']);
            //do validations
            //check width field is empty
        if (!$this->checkEmptyInputs($this->productWidth)) {
            echo 'emptyWidth';
            $checkFlag = false;
        }

            //check width for correct input
        if (!$this->checkNumberInputs($this->productWidth)) {
            echo 'wrongWidth';
            $checkFlag = false;
        }

        //check height field is empty
        if (!$this->checkEmptyInputs($this->productHeight)) {
            echo 'emptyHeight';
            $checkFlag = false;
        }

        //check height for correct input
        if (!$this->checkNumberInputs($this->productHeight)) {
            echo 'wrongHeight';
            $checkFlag = false;
        }

        //check length field is empty
        if (!$this->checkEmptyInputs($this->productLength)) {
            echo 'emptyLength';
            $checkFlag = false;
        }

        //check length for correct input
        if (!$this->checkNumberInputs($this->productLength)) {
            echo 'wrongLength';
            $checkFlag = false;
        }

        //add furniture item to the database
        if ($checkFlag && $checkFlagParent) {
            $this->productAttribute =  $this->productLength . "x" . $this->productWidth . "x" . $this->productHeight;
            $addRow = $this->addProduct();
            if ($addRow) {
                echo "added";
            } else {
                echo"notadded";
            }
        }
    }
}
