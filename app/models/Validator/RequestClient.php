<?php

namespace Validator;

use Request\Client as ClientRequest;

class RequestClient extends ValidatorAbstract
{
    const VALIDATION_CLASSES_PATH = 'Request/Client';

    protected $requestClient;

    protected $error = '';

    public function __construct(ClientRequest $requestClient)
    {
        parent::__construct();
        $this->requestClient = $requestClient;
    }


    public function isValid()
    {
        $classes = $this->validationClasses();

        foreach ($classes as $class) {
            if (! $class->isValid($this->requestClient)) {
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
