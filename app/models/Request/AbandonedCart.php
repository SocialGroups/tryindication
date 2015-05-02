<?php

namespace Request;

use Validator\RequestAbandonedCart;

class AbandonedCart
{
    protected $companyHash;

    protected $companyName;

    protected $clientEmail;

    protected $clientName;

    protected $productId;

    protected $productName;

    protected $error;

    public function __construct(array $options = [])
    {
        $this->companyHash      = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->companyName      = isset($options['companyName']) ? $options['companyName'] : '';
        $this->clientEmail      = isset($options['clientEmail']) ? $options['clientEmail'] : '';
        $this->clientName       = isset($options['clientName']) ? $options['clientName'] : '';
        $this->productId        = isset($options['productId']) ? $options['productId'] : '';
        $this->productName      = isset($options['productName']) ? $options['productName'] : '';
    }

    public function isValid()
    {
        $requestValidator = new RequestAbandonedCart($this);

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
