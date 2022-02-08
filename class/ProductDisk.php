<?php

namespace devTask;

//use devTask\ProductFunctions;
//
//require_once 'ProductFunctions.php';

class ProductDisk extends ProductFunctions
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
                            <BR>Size: ' . $attr . 'MB</p>
                            <br>
                        </div>
                    </div>
                </div>';
    }

    //override the function to view special fields
    public function viewProductFields()
    {
        echo "productDiskForm";
    }

    //override the validation function
    public function validateFields()
    {
        $checkFlag = true;
        $checkFlagParent = parent::validateFields();

        if (isset($_POST['proSize'])) {
            $this->productSize = $this->dbCon->real_escape_string($_POST['proSize']);
            //do validations
            //check disc size field is empty
            if (!$this->checkEmptyInputs($this->productSize)) {
                echo 'emptySize';
                $checkFlag = false;
            }

            //check disc field for correct input
            if (!$this->checkNumberInputs($this->productSize)) {
                echo 'wrongSize';
                $checkFlag = false;
            }

            //add disk to the database
            if ($checkFlag && $checkFlagParent) {
                $this->productAttribute = $this->productSize;
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
