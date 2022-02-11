<?php
include_once('header.php');
?>

    <body>


    <div class="page-wrap">
        <!-- Page Content-->
        <div class="container">

            <!-- Header of the page-->
            <div class="mt-3 mb- 5 pt-3 pb-2">
                <div class="row">
                    <div class="col-md-10" style="padding-top: 3px; border-bottom: 2px solid black">
                        <p class="text-black ml-3 mt-5" id="proList"><b>Product Add</b></p>
                    </div>
                    <div class="col-md-2 " style="padding-top: 1%; border-bottom: 2px solid black">

                        <button type="button" class="btn-success mt-5 mr-2 saveBtn">Save</button>
                        <button type="button" class="btn-danger  mt-5 ml-1 cancelBtn">Cancel</button>

                    </div>

                </div>


            </div>

            <!-- Contents-->
            <form class="form mb-5 mt-5" id="product_form">
                <div class="form-group row">
                    <label class="control-label col-sm-1 mt-1" for="sku">SKU</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="sku" name="sku">
                        <small class="help-block Errormsg"
                               id="skuErrormsg"></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-1 mt-1" for="name">Name</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="name" name="name">
                        <small class="help-block Errormsg"
                               id="nameErrormsg" ></small>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-sm-1 mt-1" for="price">Price ($)</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="price" name="price">
                        <small class="help-block Errormsg"
                               id="priceErrormsg" ></small>
                    </div>
                </div>

                <div class="form-group row mt-5">
                    <label class="col-sm-1 control-label mt-1"
                           for="productType">Type Switcher</label>
                    <div class="col-sm-4">
                        <select class="form-control" id="productType">
                            <option value="TypeSwitcher">Type Switcher</option>
                            <option value="ProductDisk">DVD</option>
                            <option value="ProductFurniture">Furniture</option>
                            <option value="ProductBook">Book</option>
                        </select>
                        <small class="help-block Errormsg"
                               id="typeErrormsg" ></small>
                    </div>
                </div>

                <div class="form-group d-none" id="productDiskForm">
                    <div class="form-group row">
                        <label class="control-label col-sm-1 mt-1" for="size">Size (MB)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="size" name="size">
                            <small class="help-block Errormsg"
                                   id="sizeErrormsg" ></small>
                            <div>
                                <small class="help-block"
                                       id="" >Please, provide the size of the disc</small>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="form-group d-none" id="productFurnitureForm">
                    <div class="form-group row">
                        <label class="control-label col-sm-1 mt-1" for="height">Height (CM)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="height" name="size">
                            <small class="help-block Errormsg"
                                   id="heightErrormsg" ></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1 mt-1" for="width">Width (CM)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="width" name="size">
                            <small class="help-block Errormsg"
                                   id="widthErrormsg" ></small>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="control-label col-sm-1 mt-1" for="length">Length (CM)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="length" name="size">
                            <small class="help-block Errormsg"
                                   id="lengthErrormsg" ></small>
                            <div>
                                <small class="help-block"
                                       id="" >Please, provide dimensions of the item</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="form-group d-none" id="productBookForm">
                    <div class="form-group row">
                        <label class="control-label col-sm-1 mt-1" for="weight">Weight (KG)</label>
                        <div class="col-sm-4">
                            <input type="text" class="form-control" id="weight" name="size">
                            <small class="help-block Errormsg"
                                   id="weightErrormsg" ></small>
                            <div>
                                <small class="help-block"
                                       id="" >Please, provide weight of the book</small>
                            </div>

                        </div>
                    </div>
                </div>

               <!-- <div class="form-group row mt-5 d-none">
                    <div class="alert alert-danger col-sm-5 mt-1 ml-3 mr-3" role="alert" id="errorMessage">

                    </div>
                </div>-->

            </form>

        </div>

    </div>



<?php
include_once('footer.php');












