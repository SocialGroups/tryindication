<?php

namespace Request;

use Validator\RequestAbandonedCart;

class AbandonedCart
{
    protected $companyHash;

    protected $clientId;

    protected $productId;

    protected $error;

    public function __construct(array $options = [])
    {
        $this->companyHash     = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->clientId     = isset($options['clientId']) ? $options['clientId'] : '';
        $this->productId     = isset($options['productId']) ? $options['productId'] : '';
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
