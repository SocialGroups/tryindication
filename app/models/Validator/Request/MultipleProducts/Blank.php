<?php

namespace Validator\Request\MultipleProducts;

class Blank
{
    const ERROR  = 'Campo obrigatorios nao preenchido: %s';

    // Attributes to validate
    protected static $attributes = ['companyHash', 'productsData'];

    protected $error = '';


    public function isValid($data)
    {
        foreach (self::$attributes as $attribute) {

            if (! $data->{$attribute}) {
                $this->error = sprintf(self::ERROR, $attribute);
                return false;
            }
        }

        return true;
    }


    public function getError()
    {
        return $this->error;
    }
}
