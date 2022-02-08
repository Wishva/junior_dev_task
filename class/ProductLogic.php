<?php

namespace devTask;

abstract class ProductLogic
{
    abstract protected function viewProduct($sku, $name, $price, $attr);

    abstract public function getProductData();

    abstract public function setProductData($productRow);

    abstract public function deleteProduct();

    abstract public function productMassDelete();

    abstract protected function viewProductFields();

    abstract protected function validateFields();

    abstract protected function addProduct();
}
