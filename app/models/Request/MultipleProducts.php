<?php

namespace Request;

use Validator\RequestMultipleProducts;

class MultipleProducts
{
    protected $companyHash;

    protected $productsData;

    protected $error;


    public function __construct(array $options = [])
    {
        $this->companyHash      = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->productsData      = isset($options['productsData']) ? $options['productsData'] : '';
    }

    public function isValid()
    {
        $requestValidator = new RequestMultipleProducts($this);

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
            return $this->{$attribute};
        }
    }

    public function __set($attribute, $value)
    {
        if (isset($this->$attribute)) {
            $this->{$attribute} = $value;
        }
    }
}
