<?php

namespace Validator;

use Request\MultipleProducts as MultipleProducstRequest;

class RequestMultipleProducts extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/MultipleProducts';

    protected $requestMultipleProduct;

    protected $error = '';

    public function __construct(MultipleProducstRequest $requestMultipleProduct)
    {
        parent::__construct();
        $this->requestMultipleProduct = $requestMultipleProduct;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestMultipleProduct)) {
                $this->error = $class->getError();
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
