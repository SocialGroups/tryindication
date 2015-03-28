<?php

namespace Validator;

use Request\AbandonedCart as AbandonedCartRequest;

class RequestAbandonedCart extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/AbandonedCart';

    protected $requestAbandonedCart;

    protected $error = '';

    public function __construct(AbandonedCartRequest $requestAbandonedCart)
    {
        parent::__construct();
        $this->requestAbandonedCart = $requestAbandonedCart;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestAbandonedCart)) {
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
