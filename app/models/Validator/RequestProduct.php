<?php

namespace Validator;

use Request\Product as ProductRequest;

class RequestProduct extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/Product';

    protected $requestProduct;

    protected $error = '';

    public function __construct(ProductRequest $requestProduct)
    {
        parent::__construct();
        $this->requestProduct = $requestProduct;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestProduct)) {
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
