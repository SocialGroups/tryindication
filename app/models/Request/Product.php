<?php

namespace Request;

use Validator\RequestProduct;

class Product
{
    protected $companyHash;

    protected $productId;

    protected $productPrice;

    protected $productImg;

    protected $productStatus;

    protected $productName;

    protected $productUrl;

    protected $error;


    public function __construct(array $options = [])
    {
        $this->companyHash      = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->productId        = isset($options['productId']) ? $options['productId'] : '';
        $this->productPrice     = isset($options['productPrice']) ? $options['productPrice'] : '';
        $this->productImg       = isset($options['productImg']) ? $options['productImg'] : '';
        $this->productStatus    = isset($options['productStatus']) ? $options['productStatus'] : '';
        $this->productName      = isset($options['productName']) ? $options['productName'] : '';
        $this->productUrl       = isset($options['productUrl']) ? $options['productUrl'] : '';
    }


    public function isValid()
    {
        $requestValidator = new RequestProduct($this);

        if (! $requestValidator->isValid()) {
            $this->error = $requestValidator->getError();
            return false;
        }
        return true;
    }


    public function getError()
    {
        return $this->error;
    }


    public function __get($attribute)
    {
        if (isset($this->$attribute)) {
            return null;
        }

        return $this->{$attribute};
    }


    public function __set($attribute, $value)
    {
        if (isset($this->$attribute)) {
            $this->{$attribute} = $value;
        }
    }
}
