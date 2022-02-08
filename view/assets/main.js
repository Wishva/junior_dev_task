$(document).ready(function () {

   //link the add button to the product adding page
    $("#addBtn").click(function () {
        window.location.href = "add-product.php";
    });

    //link the cancel button with the index page
    $(".cancelBtn").click(function () {
        window.location.href = "index.php";
    });

    $("#mDeleteBtn").click(function () {

        //array to include checked products
        let checkedProducts = [];
        let checkedBoxes = $(".delete-checkbox:checkbox:checked");

        //validate at least one check box selected
        if (checkedBoxes.length > 0) {
            $.each(checkedBoxes, function () {
                checkedProducts.push($(this).val()); //push checked sku to the array
            });

            //create ajax request to the product delete controller
            $.ajax({
                type: "POST",
                url: "../controller/ProductDeleteControl.php",
                data: {checkDeleteBtn:1, checkedProducts:checkedProducts},
                success: function (data) {
                    if (data) {
                        location.reload();
                    }
                },
            });
        } else {
            alert("Please select boxes to delete");
            window.location.reload();
        }
    });


    //hide all fields and show dynamically according to user selection

    let userSelector = $('#productType');

    //function for hide special fields
    function hideSpecialFields(typeName)
    {
        $('#' + typeName).removeClass("form-group").addClass("form-group d-none");
    }

    //function for show special fields
    function showSpecialFields(typeName)
    {
        $('#' + typeName).removeClass("form-group d-none").addClass("form-group");
    }

    //function for hide all special fields together
    function hideAll()
    {
        hideSpecialFields("productDiskForm");
        hideSpecialFields("productBookForm");
        hideSpecialFields("productFurnitureForm");
    }

    userSelector.change(function () {
        hideAll();
        if (userSelector.val() !== "TypeSwitcher") {
            let productType = userSelector.val();
            $.ajax({
                type: "POST",
                url: "../controller/ProductAddControl.php",
                data: {checkType:1, productType:productType},
                success: function (data) {
                    if (data) {
                        //show the related fields
                        showSpecialFields(data);

                    }
                },
            });
        } else {
            hideAll();
        }

    });



    //below section will facilitate the product adding to the data base and validations
    let skuField = $("#sku");
    let nameField = $("#name");
    let priceField = $("#price");
    let sizeField = $("#size");
    let heightField = $("#height");
    let widthField = $("#width");
    let lengthField = $("#length");
    let weightField = $("#weight");

    //function for add error border and related text for the error field
    function showError(fieldName, errorTextField, errorMsg)
    {
        $('#' + fieldName).addClass("errorRole");
        $('#' + errorTextField).text(errorMsg);
    }

    //function for remove error border and related error message
    function removeError(fieldName, errorTextField)
    {
        let inputFieldName = $('#' + fieldName);
        inputFieldName.keyup(function () {
            if (inputFieldName.val()) {
                inputFieldName.removeClass("errorRole");
                $('#' + errorTextField).text("");
            } else {
                showError(fieldName, errorTextField, "Please, submit required data")
            }
        });
    }

    //function for remove errors of special fields
    function removeErrorsSfields(fieldName,errorTextField)
    {
        let inputFieldName = $('#' + fieldName);
        inputFieldName.removeClass("errorRole");
        $('#' + errorTextField).text("");
    }

    //function for remove error border and related error message from the type field
    function removeTypeError(fieldName, errorTextField)
    {
        let inputFieldName = $('#' + fieldName);
        inputFieldName.change(function () {
            if (userSelector.val() !== "TypeSwitcher") {
                inputFieldName.removeClass("errorRole");
                $('#' + errorTextField).text("");
                removeErrorsSfields("size", "sizeErrormsg");
                removeErrorsSfields("weight", "weightErrormsg");
                removeErrorsSfields("width", "widthErrormsg");
                removeErrorsSfields("length", "lengthErrormsg");
                removeErrorsSfields("height", "heightErrormsg");
            } else {
                showError(fieldName, errorTextField, "Please, submit required data")
            }

        });
    }

    //front end validations for main 3 fields
    function validateMainFields()
    {
        let checkFlag = true;
        //front end validations for check empty inputs

        //sku field
        if (!skuField.val()) {
            showError("sku", "skuErrormsg", "Please, submit required data");
           // checkFlag = false;
        }

        //name field
        if (!nameField.val()) {
            showError("name", "nameErrormsg", "Please, submit required data");
           // checkFlag = false;
        }

        //price field
        if (!priceField.val()) {
            showError("price", "priceErrormsg", "Please, submit required data");
           // checkFlag = false;
        }

        //type field
        if (userSelector.val() === "TypeSwitcher") {
            showError("productType", "typeErrormsg", "Please, submit required data");
            checkFlag = false;
        }
        return checkFlag;
    }

    //remove all errors
    function removeAllErrors()
    {
        removeError("sku", "skuErrormsg");
        removeError("name", "nameErrormsg");
        removeError("price", "priceErrormsg");
        removeTypeError("productType", "typeErrormsg");
        removeError("size", "sizeErrormsg");
        removeError("weight", "weightErrormsg");
        removeError("width", "widthErrormsg");
        removeError("length", "lengthErrormsg");
        removeError("height", "heightErrormsg");
    }



    //function to show submit required data error
    function showRequiredError(data, phpOutPut, fieldName, errorTextField)
    {
        if (data.includes(phpOutPut)) {
            showError(fieldName, errorTextField, "Please, submit required data");
        }
    }

    //function to show indicated type error
    function showIndicatedTypeError(data, phpOutPut, fieldName, errorTextField)
    {
        if (data.includes(phpOutPut)) {
            showError(fieldName, errorTextField, "Please, provide the data of indicated type");
        }
    }

    //function to wrap all php output error messages together
    function wrapAllErrors(data)
    {
        showRequiredError(data,"emptySku", "sku", "skuErrormsg");

        showRequiredError(data,"emptyName", "name", "nameErrormsg");

        showRequiredError(data,"emptyPrice", "price", "priceErrormsg");

        showRequiredError(data,"emptySize", "size", "sizeErrormsg");

        showRequiredError(data,"emptyWeight", "weight", "weightErrormsg");

        showRequiredError(data,"emptyWidth", "width", "widthErrormsg");

        showRequiredError(data,"emptyHeight", "height", "heightErrormsg");

        showRequiredError(data,"emptyLength", "length", "lengthErrormsg");

        showIndicatedTypeError(data,"wrongPrice","price","priceErrormsg");

        showIndicatedTypeError(data,"wrongSize","size","sizeErrormsg");

        showIndicatedTypeError(data,"wrongWeight","weight", "weightErrormsg");

        showIndicatedTypeError(data,"wrongWidth","width", "widthErrormsg");

        showIndicatedTypeError(data,"wrongHeight","height", "heightErrormsg");

        showIndicatedTypeError(data,"wrongLength","length", "lengthErrormsg");

        if (data.includes("skuExists")) {
            showError(
                "sku",
                "skuErrormsg",
                "This sku is used, please try another one"
            );
        }
    }


    $(".saveBtn").click(function () {

        let checkFlag =  validateMainFields();



        if (checkFlag) {
            $.ajax({
                type: "POST",
                url: "../controller/ProductAddControl.php",
                data: {checkMainFields:1, proSku:skuField.val(), proName:nameField.val(), proPrice:priceField.val(),
                    proType:userSelector.val(), proSize:sizeField.val(), proWeight:weightField.val(),
                    proHeight:heightField.val(), proLength:lengthField.val(), proWidth:widthField.val()},
                success: function (data) {
                    if (data) {
                        //show errors according to the outputs provided by php
                        wrapAllErrors(data);
                        if (data.includes("added")) {
                            window.location.href = "index.php";
                        }
                        if (data.includes("notadded")) {
                            console.log("please lok at the class files to check if something wrong")
                        }
                    }
                },
            });
        }
        removeAllErrors();
    });







});