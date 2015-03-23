<?php

namespace Validator\Request\Query;

class Blank
{
    const ERROR  = 'Campo obrigatorios nao preenchido: %s';

    // Attributes to validate
    protected static $attributes = ['companyHash', 'value'];

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
