<?php

namespace Request;

use Validator\RequestQuery;

class Query
{
    protected $companyHash;

    protected $value;

    protected $popularity;

    protected $error;


    public function __construct(array $options = [])
    {
        $properties = get_object_vars($this);
        unset($properties['error']);
        $properties = array_keys($properties);

        foreach ($properties as $property) {
            if (isset($options[$property])) {
                $this->{$property} = $options[$property];
            }
        }
    }


    public function isValid()
    {
        $requestValidator = new RequestQuery($this);

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
        if (! isset($this->$attribute)) {
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
