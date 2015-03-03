<?php

namespace Validator\Request\Product;

class Status
{
    const ERROR  = 'O campo :productStatus deve conter a value (Activated) para produtos ativos ou (Disabled) para produtos desativados';

    // Attributes to validate
    protected static $attributes = ['productStatus'];

    protected $error = '';


    public function isValid($data)
    {
        foreach (self::$attributes as $attribute) {

            if ($data->{$attribute} == 'Activated' OR $data->{$attribute} == 'Disabled') {
                return true;
            }

            $this->error = sprintf(self::ERROR, $attribute);
            return false;
        }
    }


    public function getError()
    {
        return $this->error;
    }
}
