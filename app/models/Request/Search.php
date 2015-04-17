<?php

namespace Request;

use Validator\RequestSearch;

class Search
{
    protected $companyHash;

    protected $answerKey;

    protected $productId;

    protected $relationshipType;

    protected $error;


    public function __construct(array $options = [])
    {
        $this->companyHash          = isset($options['companyHash']) ? $options['companyHash'] : '';
        $this->answerKey             = isset($options['answerKey']) ? $options['answerKey'] : '';
        $this->productId            = isset($options['productId']) ? $options['productId'] : '';
        $this->relationshipType     = isset($options['relationshipType']) ? $options['relationshipType'] : '';
    }

    public function isValid()
    {
        $requestValidator = new RequestSearch($this);

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
