<?php

namespace devTask;

//use devTask\ProductFunctions;
//
//require_once 'ProductFunctions.php';

class ProductBook extends ProductFunctions
{
    //override the view product function to Disk
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
                            <BR>Weight: ' . $attr . 'KG</p>
                            <br>
                        </div>
                    </div>
                </div>';
    }

    //override the function to view special fields
    public function viewProductFields()
    {
        echo "productBookForm";
    }

    //override the validation function
    public function validateFields()
    {
        $checkFlag = true;
        $checkFlagParent = parent::validateFields();

        if (isset($_POST['proWeight'])) {
            $this->productWeight = $this->dbCon->real_escape_string($_POST['proWeight']);
            //do validations
            //check book weight field is empty
            if (!$this->checkEmptyInputs($this->productWeight)) {
                echo 'emptyWeight';
                $checkFlag = false;
            }

            //check book weight for correct input
            if (!$this->checkNumberInputs($this->productWeight)) {
                echo 'wrongWeight';
                $checkFlag = false;
            }

            //add book to the database
            if ($checkFlag && $checkFlagParent) {
                $this->productAttribute =  $this->productWeight;
                $addRow = $this->addProduct();
                if ($addRow) {
                    echo "added";
                } else {
                    echo"notadded";
                }
            }
        }
    }
}
