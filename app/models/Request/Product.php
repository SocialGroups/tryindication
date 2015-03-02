<?php

namespace Request;

use Validator\RequestProduct;

class Product
{
    protected $companyHash;

    protected $id;

    protected $price;

    protected $img;

    protected $status;

    protected $error;


    public function __construct(array $options = [])
    {
        $this->companyHash  = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->id           = isset($options['id']) ? $options['id'] : '';
        $this->price        = isset($options['price']) ? $options['price'] : '';
        $this->img          = isset($options['img']) ? $options['img'] : '';
        $this->status       = isset($options['status']) ? $options['status'] : '';
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
