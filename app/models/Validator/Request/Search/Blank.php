<?php

namespace Validator\Request\Search;

class Blank
{
    const ERROR  = 'Campo obrigatorio nao preenchido: %s';

    // Attributes to validate
    protected static $attributes = ['companyHash', 'answerKey', 'productId', 'relationshipType'];

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
