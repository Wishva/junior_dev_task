<?php

namespace devTask;

trait ProductValidation
{
    //function for check empty input fields
    public function checkEmptyInputs($fieldName)
    {
        if (!empty($fieldName) &&  $fieldName != "" && strlen(trim($fieldName)) > 0) {
            return true;
        } else {
            return false;
        }
    }

    // function to check price related fields for only numbers and decimal points
    public function checkNumberInputs($fieldName)
    {
        if (preg_match("/^\d*\.?\d*$/", $fieldName)) {
            return true;
        } else {
            return false;
        }
    }
}
