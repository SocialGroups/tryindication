<?php

namespace Validator\Request\AbandonedCart;

class Blank
{
    const ERROR  = 'Campo obrigatorios nao preenchido: %s';

    // Attributes to validate
    protected static $attributes = ['companyHash','companyName','clientEmail','clientName','productId','productName'];

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
