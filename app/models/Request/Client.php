<?php

namespace Request;

use Validator\RequestClient;

class Client
{
    protected $companyHash;

    protected $clientId;

    protected $clientEmail;

    protected $error;

    public function __construct(array $options = [])
    {
        $this->companyHash     = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->clientId        = isset($options['clientId']) ? $options['clientId'] : '';
        $this->clientEmail     = isset($options['clientEmail']) ? $options['clientEmail'] : '';
    }

    public function isValid()
    {
        $requestValidator = new RequestClient($this);

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
